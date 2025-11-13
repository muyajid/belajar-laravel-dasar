<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassRoom;

class AdminStudent extends Controller
{
     public function index()
    {
        $students = Student::with('classroom')->get();
        $classrooms = Classroom::all();

        return view('admin.student', [
            'title' => 'Data Students',
            'students' => $students,
            'classrooms' => $classrooms
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'nullable|date',
            'class_rooms_id' => 'required|exists:class_rooms,id',
        ]);

        Student::create($request->all());

        return redirect()->back()->with('success', 'Student berhasil ditambahkan!');
}
}
