<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Subject;

class AdminTeacher extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Teacher::with('subject')->get();
        $subject = Subject::doesntHave('teacher')->get();
        
        return \view('admin.teacher', [
            'title' => "Data Teacher",
            'teacher' => $data,
            'subject' => $subject
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'name' => 'required',
            'subject_id' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required'
        ]);

        Teacher::create([
            'name' => $validasi['name'],
            'subject_id' => $validasi['subject_id'],
            'phone' => $validasi['phone'],
            'email' => $validasi['email'],
            'address' => $validasi['address']
        ]);
        
        return \redirect()->route('admin.teacher.index')->with('succes', 'Teacher dan subject berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $subject = Subject::findOrFail($teacher->subject_id);

        $validasi = $request->validate([
            'name' => 'required',
            'subject_id' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required'
        ]);
        $teacher->update([
            'name' => $validasi['name'],
            'subject_id' => $validasi['subject_id'],
            'phone' => $validasi['phone'],
            'email' => $validasi['email'],
            'address' => $validasi['address']
        ]);
        
        return \redirect()->route('admin.teacher.index')->with('succes', 'Teacher dan subject berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $subject = Subject::findOrFail($teacher->subject_id);

        $teacher->delete();
        if ($subject) {
            $subject->delete();
        }

        return \redirect()->route('admin.teacher.index')->with('succes', 'Teacher dan subject berhasil di hapus');
    }
}
