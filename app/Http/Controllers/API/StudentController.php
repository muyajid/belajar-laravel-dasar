<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index() {
        $student = Student::with('classroom')->get();

        return \response()->json([
            'status' => 'success',
            'message' => 'berhasil get data siswa',
            'data' => $student
        ]);
    }
}
