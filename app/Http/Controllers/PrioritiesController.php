<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Priorities;

class PrioritiesController extends Controller
{
    public function index()
    {
        $priorities = Priorities::oldest()->get();

        return view(
            'admin.priorities.index',
            [
                'data' => $priorities,
            ]
        );
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'priorities_name' => 'required'
        ]);

        $input = $request->all();

        Priorities::create($input);

        return redirect('/admin/priorities');
    }

    public function show(Priorities $priorities)
    {
        //
    }

    public function edit(Priorities $priority)
    {
        return view('admin.priorities.edit', [
            'priorities' => $priority
        ]);
    }


    public function update(Request $request, Priorities $priority)
    {
        $validatedData = $request->validate([
            'priorities_name' => 'required'
        ]);

        $priority->update($validatedData);

        return redirect('/admin/priorities');
    }

    public function destroy(Priorities $priority)
    {
        $priority->delete();

        return redirect('/admin/priorities');
    }
}
