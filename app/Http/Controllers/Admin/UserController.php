<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->withCount('loan')
            ->where('role', 2)
            ->get();

        return view('pages.admin.user.index', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.user')->with('status', 'Sukses menghapus user ' . $user->name);
    }
}
