<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function list(): View
    {
        $data = [
            'title' => "List Users",
            'users' => User::where('id', '!=', auth()->id())->orderBy("created_at", "desc")->paginate(10)
        ];

        return view("admin.users.list", $data);
    }
    public function create(): View
    {
        $data = [
            'title' => "Create User",
        ];

        return view("admin.users.create", $data);
    }
    public function edit($id): View
    {
        $data = [
            'title' => "Edit User",
            'user' => User::find($id)
        ];

        return view("admin.users.edit", $data);
    }
    public function save(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'role' => ['required', Rule::in(['admin', 'agent', 'user'])],
            'password' => 'required|string|min:8|max:255',
            'password2' => 'required|same:password'
        ]);



        User::create($validate);

        return redirect("/admin/users")->with('success', "User Successfully Saved");
    }
    public function delete(Request $request): RedirectResponse
    {
        $id = $request->id;

        User::where('id', $id)->delete();

        return redirect("/admin/users")->with('success', "User Successfully Deleted");
    }
    public function update(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $request->id . ',id',
            'role' => ['required', Rule::in(['admin', 'agent', 'user'])],
        ]);

        $users = User::find($request->id);

        $users->update([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'role' => $validate['role']
        ]);

        return redirect("/admin/users")->with('success', "User Successfully Updated");
    }
}
