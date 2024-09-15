<?php

namespace App\Http\Controllers;

use App\Models\Labels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('admin');
        $label = Labels::all();

        return view('labels.labels', compact('label'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('admin');

        return view('labels.form-labels');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('admin');

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $label = new Labels();

        $label->label_name = $request->name;
        $label->save();

        return Redirect::route('label.index')->with('status', 'add-label');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('admin');

        $label = Labels::find($id);

        return view('labels.form-labels', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('admin');

        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $label = Labels::find($id);

        $label->label_name = $request->name;
        $label->save();

        return Redirect::route('label.index')->with('status', 'edit-label');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('admin');
        
        $label = Labels::find($id);
        $label->delete();

        return Redirect::route('label.index')->with('status', 'delete-label');
    }
}
