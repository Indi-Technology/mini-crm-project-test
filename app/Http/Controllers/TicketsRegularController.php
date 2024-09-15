<?php

namespace App\Http\Controllers;

use App\Models\Labels;
use App\Models\Tickets;
use App\Models\Categories;
use App\Models\Priorities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TicketsRegularController extends Controller
{
    public function index()
    {
        $tickets = Tickets::where('user_id', Auth::id())->oldest()->get();

        return view('regular.tickets-reg.index', [
            'data' => $tickets,
        ]);
    }

    public function create()
    {
        $labels = Labels::all();
        $categories = Categories::all();
        $priorities = Priorities::all();

        return view('regular.tickets-reg.create', compact('labels', 'categories', 'priorities'));
    }

    // Method untuk menyimpan tiket
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'title' => 'required',
            'message' => 'required',
            'id_label' => 'required',
            'id_categories' => 'required',
            'id_priorities' => 'required',
            'status' => 'required',
            'attachment.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp'
        ]);

        // Membuat instance Tickets dan mengisi dengan data input
        $tiket = new Tickets();
        $tiket->title = $request->title;
        $tiket->message = $request->message;
        $tiket->id_label = $request->id_label;
        $tiket->id_categories = $request->id_categories;
        $tiket->id_priorities = $request->id_priorities;
        $tiket->status = $request->status;
        $tiket->user_id = Auth::id();

        // Jika ada file attachment yang di-upload, proses dan simpan file
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $tiket->attachment = $filename;
        }

        $tiket->save();

        return redirect()->route('regular.tickets.index')->with('success', 'Tiket berhasil dibuat.');
    }
}
