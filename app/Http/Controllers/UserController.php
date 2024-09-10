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
    public function edit($id): View|RedirectResponse
    {
        $user = User::find($id);


        if ($user->id === Auth::id()) {
            return redirect('/admin/users')->with('error', 'Cannot edit yourself from here, please use profile page');
        }

        $data = [
            'title' => "Edit User",
            'user' => $user
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

        if ($id == Auth::id()) {
            return redirect("/admin/users")->with('error', 'Cannot delete yourself from here, please use profile page');
        }

        User::where('id', $id)->delete();

        return redirect("/admin/users")->with('success', "User Successfully Deleted");
    }
    public function update(Request $request): RedirectResponse
    {
        $id = $request->id;

        if ($id == Auth::id()) {
            return redirect("/admin/users")->with('error', 'Cannot edit yourself from here, please use profile page');
        }

        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id . ',id',
            'role' => ['required', Rule::in(['admin', 'agent', 'user'])],
        ]);

        $users = User::find($id);

        $users->update([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'role' => $validate['role']
        ]);

        return redirect("/admin/users")->with('success', "User Successfully Updated");
    }
}
