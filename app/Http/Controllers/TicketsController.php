<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\Labels;
use App\Models\Priorities;
use App\Models\User;
use PHPUnit\Framework\Attributes\Ticket;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class TicketsController extends Controller
{
    public function index()
    {
        $tickets = Tickets::oldest()->get();

        return view(
            'admin.tickets.index',
            [
                'data' => $tickets,
            ]
        );
    }

    public function create()
    {
        $tickets = Tickets::all();
        $labels = Labels::all();
        $categories = Categories::all();
        $priorities = Priorities::all();


        return view('admin.tickets.create', compact('labels', 'categories', 'priorities'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'message' => 'required',
            'id_label' => 'required',
            'id_categories' => 'required',
            'id_priorities' => 'required',
            'status' => 'required',
            'attachment.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp'
        ]);

        $input = $request->all();
        // dd($input);


        if ($request->hasFile('attachment')) {

            $image = $request->file('attachment');
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['attachment'] = $profileImage;
        }


        Tickets::create($input);

        return redirect('/admin/tickets');
    }

    public function show(Ticket $ticket)
    {
        //
    }

    public function edit(Tickets $ticket)
    {
        $labels = Labels::all();
        $categories = Categories::all();
        $priorities = Priorities::all();
        $users = User::where('role', 'agent')->get();

        return view('admin.tickets.edit', compact('ticket', 'labels', 'categories', 'priorities', 'users'));
    }


    public function update(Request $request, Tickets $ticket)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
            'id_label' => 'required',
            'id_categories' => 'required',
            'id_priorities' => 'required',
            'status' => 'required',
            'attachment.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
        ], [
            'title.required' => 'Nama anak harus diisi',
            'message.required' => 'Jenis kelamin harus diisi',
            'id_label.required' => 'Tanggal lahir harus diisi',
            'id_categories.required' => 'Nama orang tua harus diisi',
            'id_priorities.required' => 'Nomor wa orang tua harus diisi',
            'status.required' => 'status harus diisi',
            'attachment.image' => 'File attachment harus diisi dengan file jpeg, png, jpg, gif, svg, webp',
        ]);

        $input = $request->all();

        $data_ticket = Tickets::find($ticket->id_ticket);

        if ($image = $request->file("attachment")) {
            // Hapus file lama jika ada
            $path = "images/";

            if ($data_ticket->attachment != '' && $data_ticket->attachment != null) {
                $file_old = $path . $data_ticket->attachment;
                if (File::exists(public_path($file_old))) {
                    File::delete(public_path($file_old));
                }
            }

            // Unggah file baru
            $destinationPath = "images/";
            $profileImage = date("YmdHis") . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input["attachment"] = $profileImage;
        } else {
            unset($input["attachment"]);
        }


        $ticket->update($input);

        return redirect('/admin/tickets');
    }


    public function destroy(Tickets $ticket)
    {
        File::delete('images/' . $ticket->attachment);
        $ticket->delete();

        return redirect('/admin/tickets');
    }
}
