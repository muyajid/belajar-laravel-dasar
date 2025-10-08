<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    //
    public function index() {
        $data = Teacher::all();

        return \view('teacher', [
            'title' => 'Ini Halaman Wali Kelas',
            'data' => $data,
        ]);
    }
}
