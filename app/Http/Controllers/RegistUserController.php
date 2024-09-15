<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistUserController extends Controller
{
    public function index()
    {
        $user = User::oldest()->get();

        return view(
            'admin.user.index',
            [
                'data' => $user,
            ]
        );
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'role' => 'required',
        ], [
            'name.required' => 'name wajib diisi',
            'email.required' => 'email wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'password wajib diisi',
            'role.required' => 'role wajib diisi',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->back()->with('success', 'User berhasil ditambahkan!');
    }


    public function show(User $user)
    {
        //
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'role' => 'required',
            'password' => 'nullable',
        ], [
            'name.required' => 'name wajib diisi',
            'email.required' => 'email wajib diisi',
            'role.required' => 'role wajib diisi',
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect('admin/RegistUser');
    }

    public function destroy($id)
    {
        User::where("id", $id)->delete();

        return redirect('admin/RegistUser');
    }
}
