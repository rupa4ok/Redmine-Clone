<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function showMembers()
    {
        $users = User::all();
        return view('members', ['users' => $users]);
    }
}
