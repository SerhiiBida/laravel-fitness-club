<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.show_login');
    }
}
