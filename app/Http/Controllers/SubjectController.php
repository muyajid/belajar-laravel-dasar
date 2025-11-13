<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    //
    public function index() {
        $data = Subject::all();

        return \view('subject', [
            'title' => "Ini Halaman Subject",
            'data' => $data,
        ]);
    }
}
