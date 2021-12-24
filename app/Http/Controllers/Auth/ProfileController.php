<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ProfileRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('auth.profile');
    }

    public function update(ProfileRequest $profileRequest)
    {
        if ($profileRequest->password) {
            auth()->user()->update(['password' => bcrypt($profileRequest->password)]);
        }

        auth()->user()->update([
            'name' => $profileRequest->name,
            'email' => $profileRequest->email,
        ]);

        return redirect()->back()->with('success', 'Profile updated.');
    }
}
