<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Ticket;
use App\Models\Label;
use App\Models\Category;
use App\Models\User;
use App\Mail\TicketCreated;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(auth()->user()->role === 'agent') {
            $query = Ticket::where('agent_id', auth()->id());
        } elseif(auth()->user()->role === 'user') {
            $query = Ticket::where('user_id', auth()->id());
        } else {
            $query = Ticket::query();
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('category_id', $request->category);
            });
        }

        $query->orderBy('created_at', 'desc');
        $tickets = $query->paginate(10);

        $unassigned = Ticket::whereNull('agent_id')->count();
        $assigned = Ticket::whereNotNull('agent_id')->count();
        $status_open = Ticket::where('status', 'open')->count();
        $status_closed = Ticket::where('status', 'closed')->count();

        $count_data = [
            'unassigned' => $unassigned,
            'assigned' => $assigned,
            'open' => $status_open,
            'closed' => $status_closed,
        ];
        $categories = Category::all();

        return view('tickets.index', compact('tickets', 'categories', 'count_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $labels = Label::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('tickets.create', compact('labels', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' =>  ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'categories' => ['required', 'array'],
            'categories.*' => ['exists:categories,id'],
            'labels' => ['required', 'array'],
            'labels.*' => ['exists:labels,id'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'mimes:pdf,jpeg,png,jpg', 'max:2048'],
            'priority' => ['required', 'in:low,medium,high'],
        ]);

        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'user_id' => auth()->id(),
        ]);

        $ticket->categories()->sync($request->categories);
        $ticket->labels()->sync($request->labels);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                $originalName = pathinfo($attachment->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $attachment->getClientOriginalExtension();
                $uniqueName = $originalName . '_' . Str::uuid() . '.' . $extension;
                $path = $attachment->storeAs('attachments', $uniqueName, 'public');
                $ticket->attachments()->create([
                    'file_path' => $path,
                    'original_name' => $originalName,
                    'extension' => $extension,
                    'size' => $attachment->getSize(),
                ]);
            }
        }

        $adminEmail = User::where('role', 'admin')->pluck('email');
        Mail::to($adminEmail)->send(new TicketCreated($ticket));

        // return redirect(route('tickets.index'))->with('success', 'Ticket created successfully.');
        return redirect(route('tickets.show', $ticket->id))->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(auth()->user()->role === 'admin') {
            $ticket = Ticket::findOrFail($id);
        } elseif(auth()->user()->role === 'agent') {
            $ticket = Ticket::where('agent_id', auth()->id())->findOrFail($id);
        } elseif(auth()->user()->role === 'user') {
            $ticket = Ticket::where('user_id', auth()->id())->findOrFail($id);
        }
        $agents = User::where('role', 'agent')->orderBy('name')->get();

        return view('tickets.show', compact('ticket', 'agents'));
    }

    public function assign(Request $request, string $id)
    {
        $request->validate([
            'agent_id' => ['required', 'exists:users,id'],
        ]);


        $ticket = Ticket::findOrFail($id);
        $ticket->update([
            'agent_id' => $request->agent_id,
        ]);

        return redirect(route('tickets.show', $id))->with('success', 'Ticket assigned successfully.');
    }

    public function close(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update([
            'status' => 'closed',
        ]);

        return redirect(route('tickets.show', $id))->with('success', 'Ticket closed successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $labels = Label::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $agents = User::where('role', 'agent')->orderBy('name')->get();
        $users = User::where('role', 'user')->orderBy('name')->get();

        return view('tickets.edit', compact('ticket', 'labels', 'categories', 'agents', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' =>  ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'categories' => ['required', 'array'],
            'categories.*' => ['exists:categories,id'],
            'labels' => ['required', 'array'],
            'labels.*' => ['exists:labels,id'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'mimes:pdf,jpeg,png,jpg', 'max:2048'],
            'priority' => ['required', 'in:low,medium,high'],
            'status' => ['required', 'in:open,closed'],
            'agent_id' => ['nullable', 'exists:users,id'],
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => $request->status,
            'agent_id' => $request->agent_id,
        ]);

        $ticket->categories()->sync($request->categories);
        $ticket->labels()->sync($request->labels);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                $originalName = pathinfo($attachment->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $attachment->getClientOriginalExtension();
                $uniqueName = $originalName . '_' . Str::uuid() . '.' . $extension;
                $path = $attachment->storeAs('attachments', $uniqueName, 'public');
                $ticket->attachments()->create([
                    'file_path' => $path,
                    'original_name' => $originalName,
                    'extension' => $extension,
                    'size' => $attachment->getSize(),
                ]);
            }
        }

        return redirect(route('tickets.show', $id))->with('success', 'Ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->user()->role === 'admin') {
            $ticket = Ticket::findOrFail($id);
        } elseif (auth()->user()->role === 'agent') {
            $ticket = Ticket::where('agent_id', auth()->id())->findOrFail($id);
        } elseif (auth()->user()->role === 'user') {
            $ticket = Ticket::where('user_id', auth()->id())->findOrFail($id);
        }

        $ticket->delete();

        // deleting file attachments
        foreach ($ticket->attachments as $attachment) {
            $attachment->delete();
        }

        return redirect(route('tickets.index'))->with('success', 'Ticket deleted successfully.');
    }
}
