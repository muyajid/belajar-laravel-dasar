<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KontakController extends Controller
{
    //
        public function kontak () {
        $data = [
            'noHp' => "0821-3263-0818",
            'email' => "kamuyazidkan@gmail.com"
        ];
        return \view('kontak', $data, [
            'title' => "Kontak -Yazid"
        ]);
    }
}
