<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function create() {
        return view('register.create');
    }

    public function store() {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|max:255|min:8'
        ]);

        // $attributes['password'] = bcrypt($attributes['password']); One way of encrypting passwords instead of in the model with a mutator.

        User::create($attributes);

        // session()->flash('success', 'Your account has been created.'); // Manual wat of doing this before the redirect. Otherwise you can use with() after the redirect.

        return redirect('/')->with('success', 'Your account has been created.');
    }
}
