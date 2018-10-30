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
        auth()->user()->update([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);
        return redirect(route('account.edit'));
    }

    public function destroy()
    {
        $user = Auth::user();
        $user->delete();

        return redirect(route('index'));
    }

    public function changePassword(Request $request)
    {
        $password = $request->input('password');
        $newPassword = $request->input('new_password');
        $newPasswordConfirmation = $request->input('new_password_confirmation');
        auth()->user()->update([
                'password' => Hash::make($newPassword)
        ]);
    }
}
