<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index() {
        $users = User::withCount('orders')->get();
        return Inertia::render('Users', [
            'users' => $users,
        ]);
    }
}
