<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('account/edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:2',
            'email' => 'required|max:254|min:5|unique:users'
        ]);
        auth()->user()->update([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);
        session()->flash('notification', 'Success to update account');
        return redirect(route('account.edit'));
    }

    public function destroy()
    {
        $user = Auth::user();
        $deleted = $user->delete();
        $deleted ?: session()->flash('error', 'error');
        return redirect(route('index'));
    }
}
