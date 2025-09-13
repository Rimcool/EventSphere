<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // We'll add admin middleware later after creating it
    }

    public function showUsers()
    {
        // Get all users with their event count
        $users = User::withCount('events')->get();
        return view('admin.showusers', compact('users'));
    }
}
