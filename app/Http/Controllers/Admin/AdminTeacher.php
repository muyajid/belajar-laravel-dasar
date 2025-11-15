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
        
        return \view('admin.teacher', [
            'title' => "Data Teacher",
            'teacher' => $data
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
            'subject_name' => 'required',
            'subject_description' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required'
        ]);

        $subject = Subject::create([
            'name' => $validasi['subject_name'],
            'description' => $validasi['subject_description']
        ]);

        Teacher::create([
            'name' => $validasi['name'],
            'subject_id' => $subject->id,
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
            'subject_name' => 'required',
            'subject_description' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        'address' => 'required'
        ]);

        $subject->update(['name' => $validasi['subject_name'], 'description' => $validasi['subject_description']]);
        $teacher->update([
            'name' => $validasi['name'],
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
