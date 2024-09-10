<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function list()
    {
        $data = [
            'title' => 'List Labels',
            'labels' => Label::orderBy('created_at', 'desc')->paginate(10)
        ];


        return view('admin.labels.list', $data);
    }

    public function create()
    {
        $data = [
            'title' => "Create Label",
        ];

        return view("admin.labels.create", $data);
    }

    public function save(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'label_name' => 'required|min:3'
        ]);

        Label::create($validate);

        return redirect('/admin/labels')->with('success', 'Label Sucessfully Saved');
    }

    public function edit($id)
    {
        $data = [
            'title' => "Edit Label",
            'label' => Label::find($id)
        ];

        return view("admin.labels.edit", $data);
    }

    public function delete(Request $request): RedirectResponse
    {
        $id = $request->id;

        Label::where('id', $id)->delete();

        return redirect("/admin/labels")->with('success', "Label Successfully Deleted");
    }

    public function update(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'label_name' => 'required|min:3'
        ]);

        $labels = Label::find($request->id);

        $labels->update([
            'label_name' => $validate['label_name']
        ]);

        return redirect('/admin/labels')->with('success', 'Label Successfully Updated');
    }
}
