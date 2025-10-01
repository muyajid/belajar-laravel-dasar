<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{

    public function profile () {
        $data = [
            'nama' => "Muhammad Yazid Arsy",
            'tanggalLahir' => "15 Januari 2009",
            'asalDaerah' => "Malang, Jawa Timur",
            'kelas' => "11 RPLG 1",
            'sekolah' => "SMK RUS KUDUS"
        ];
        return \view('profile', $data, [
            'title' => "Profile -Yazid"
        ]);
    }
}
