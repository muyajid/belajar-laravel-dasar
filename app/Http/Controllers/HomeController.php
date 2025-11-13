<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {
        return \view('beranda');
    }

    public function home() {
    return \view('home', [
            'title' => 'Home -Yazid'
        ]);
    }
}
