<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    public function create()
    {
        return inertia('UserAccount/Create');
    }

    public function store(Request $request)
    {
        $user = User::create($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]));
        auth()->login($user);
        event(new Registered($user));

        return redirect()->route('listing.index')
            ->with('success', 'Your account has been created!');
    }
}
