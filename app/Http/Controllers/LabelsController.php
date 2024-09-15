<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Labels;
use RealRashid\SweetAlert\Facades\Alert;

class LabelsController extends Controller
{
    public function index()
    {
        $labels = Labels::oldest()->get();

        return view(
            'admin.labels.index',
            [
                'data' => $labels,
            ]
        );
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'label_name' => 'required'
        ]);

        $input = $request->all();

        Labels::create($input);

        return redirect('/admin/labels');
    }

    public function show(Labels $label)
    {
        //
    }

    public function edit(Labels $label)
    {
        return view('admin.labels.edit', [
            'labels' => $label
        ]);
    }


    public function update(Request $request, Labels $label)
    {
        $validatedData = $request->validate([
            'label_name' => 'required'
        ]);

        $label->update($validatedData);

        return redirect('/admin/labels');
    }

    public function destroy(Labels $label)
    {
        $label->delete();

        return redirect('/admin/labels');
    }
}
