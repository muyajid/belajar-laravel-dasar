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
        $validasi = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'nullable|date',
            'class_rooms_id' => 'required|exists:class_rooms,id',
        ]);

        Student::create([
            'nama' => $validasi['nama'],
            'email' => $validasi['email'],
            'alamat' => $validasi['alamat'],
            'tanggal_lahir' => $validasi['tanggal_lahir'],
            'class_rooms_id' => $validasi['class_rooms_id']
        ]);
        return \redirect()->route('admin.student.index')->with('succes', 'Student berhasil ditambahkan!');
    }
    public function update(Request $request, string $id) {
        $student = Student::findOrFail($id);

        $validasi = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'alamat' => 'required|string',
            'tanggal_lahir' => 'nullable|date',
            'class_rooms_id' => 'required|exists:class_rooms,id',
        ]);

        $student->update($validasi);
        return \redirect()->route('admin.student.index')->with('succes', 'Student berhasil diupdate!');
    }
    public function destroy(string $id) {
        $student = Student::findOrFail($id);
        $student->delete();

        return \redirect()->route('admin.student.index')->with('succes', 'Student berhasil dihapus!');
    }
}
