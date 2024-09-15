<?php

namespace App\Http\Controllers;

use App\Mail\sendMail;
use App\Models\Categories;
use App\Models\Labels;
use App\Models\LogTicket;
use App\Models\Ticket;
use App\Models\User;
use App\PriorityEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('admin')) {
            $tiket = Ticket::paginate(10);
        } elseif (Gate::allows('agent')) {
            // $categories = Ticket::where('assigned_to', Auth::id())->with('tiket_category')->get();
            $tiket = Ticket::where('assigned_to', Auth::id())->paginate(5);
            // dd($categories);
        } else {
            $tiket = Ticket::where('users_id', Auth::id())->paginate(5);
        }

        $categories = Categories::all();

        return view('tickets.ticket', compact('tiket', 'categories'));
    }

    public function dashboard()
    {
        Gate::authorize('admin');

        $tiket_count = Ticket::count();
        $status_open = Ticket::where('status', 'Open')->count();
        $status_progress = Ticket::where('status', 'In Progress')->count();
        $status_closed = Ticket::where('status', 'Closed')->count();
        return view('dashboard', compact('tiket_count', 'status_open', 'status_progress', 'status_closed'));
    }

    public function detail(string $id)
    {
        $tiket = Ticket::find($id);
        return view('tickets.detail-ticket', compact('tiket'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $label = Labels::all();
        $categories = Categories::all();

        return view('tickets.form-ticket', compact('label', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'labels' => 'required',
            'categories' => 'required',
            'priority' => ['required', 'string', Rule::in(array_column(PriorityEnum::cases(), 'value'))],
            'attachment' => 'required|file|max:2048',
        ]);

        $file = $request->file('attachment');
        $file_name = time() . "-" . $file->getClientOriginalName();
        $path = 'attachment/' . $file_name;
        Storage::disk('public')->put($path, file_get_contents($file));

        $default_status = 'Open';
        $ticket = new Ticket();
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->priority = $request->priority;
        $ticket->status = $default_status;
        $ticket->attachment_file = $path;
        $ticket->users_id = Auth::id();
        $ticket->save();

        $id_label = $request->labels;
        $id_categories = $request->categories;

        $ticket->tiket_label()->attach($id_label);
        $ticket->tiket_category()->attach($id_categories);

        // Log
        $log = LogTicket::create([
            'ticket_title' => $request->title,
            'ticket_priority' => $request->priority,
            'ticket_status' => $default_status,
            'action' => 'Create ticket',
            'updated_by' => Auth::user()->role,
            'updater_name' => Auth::user()->name,
        ]);

        // send email
        $data = [
            'user_name' => Auth::user()->name,
            'created_at' => $ticket->created_at,
            'title' => $ticket->title,
            'priority' => $ticket->priority,
            'status' => $ticket->priority,
            'ticket_link' => route('ticket.detail', ['id' => $ticket->id])
        ];
        $email_target = Auth::user()->email;
        Mail::to($email_target)->send(new sendMail($data));

        return Redirect::route('ticket.index')->with('status', 'create-tiket');
    }

    /**
     * Display the specified resource.
     */
    public function filter(Request $request)
    {
        if (Gate::allows('admin_agent')) {
            $tiket = Ticket::where('status', $request->status)
                ->orWhere('priority', $request->priority)
                ->orWhereHas('tiket_category', function ($query) use ($request) {
                    $query->where('category_id', $request->category);
                })
                ->get();
        } else {
            $tiket = Ticket::where('users_id', Auth::id())
                ->where(function ($query) use ($request) {
                    $query->where('priority', $request->priority)
                        ->orWhere('status', $request->status)
                        ->orWhereHas('tiket_category', function ($query) use ($request) {
                            $query->where('category_id', $request->category);
                        });
                })
                ->get();
        }

        $categories = Categories::all();

        return view('tickets.ticket', compact('tiket', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('admin_agent');

        $ticket = Ticket::find($id);
        $ticket_label = Ticket::with('tiket_label')->findOrFail($id);
        $ticket_category = Ticket::with('tiket_category')->findOrFail($id);
        $labels = Labels::all();
        $categories = Categories::all();
        $agent = User::where('role', 'agent')->get();

        return view('tickets.form-ticket', compact('ticket', 'labels', 'categories', 'ticket_label', 'ticket_category', 'agent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('admin_agent');

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'priority' => ['required', 'string', Rule::in(array_column(PriorityEnum::cases(), 'value'))],
            'labels' => 'required',
            'categories' => 'required',
            'attachment' => 'file|max:2048',
        ]);

        $ticket = Ticket::find($id);
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->priority = $request->priority;
        $ticket->status = $request->status;
        $ticket->assigned_to = $request->assigned_to ?: $ticket->assigned_to;
        $ticket->save();

        $id_label = $request->labels;
        $id_categories = $request->categories;

        $ticket->tiket_label()->sync($id_label);
        $ticket->tiket_category()->sync($id_categories);

        // Log
        $log = LogTicket::create([
            'ticket_title' => $request->title,
            'ticket_priority' => $request->priority,
            'ticket_status' => $request->status,
            'action' => 'Update ticket',
            'updated_by' => Auth::user()->role,
            'updater_name' => Auth::user()->name,
        ]);

        return Redirect::route('ticket.index')->with('status', 'create-tiket');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('admin');

        $ticket = Ticket::find($id);

        Storage::disk('public')->delete($ticket->attachment_file);
        $ticket->delete();

        // Log
        $log = LogTicket::create([
            'ticket_title' => $ticket->title,
            'ticket_priority' => $ticket->priority,
            'ticket_status' => $ticket->status,
            'action' => 'Delete ticket',
            'updated_by' => Auth::user()->role,
            'updater_name' => Auth::user()->name,
        ]);

        return Redirect::route('ticket.index')->with('status', 'delete-tiket');
    }

    public function log()
    {
        Gate::authorize('admin_agent');

        $log = LogTicket::orderBy('id', 'desc')->paginate(10);

        return view('log-ticket', compact('log'));
    }
}
