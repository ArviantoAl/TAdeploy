<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function data_user()
    {
        $users = User::query()->paginate(10);
        // if (auth()->user()->user_role == 1) {
        //     return view('dashboard.admin.user.user', compact('users'));
        // }
        return view('dashboard.admin.users.user', compact('users'));
    }
}
