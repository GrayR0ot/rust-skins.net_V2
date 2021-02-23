<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PrivacyController extends Controller
{
    public function index() {
        return Inertia::render('PrivacyPolicy');
    }
}
