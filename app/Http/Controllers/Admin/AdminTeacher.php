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
    public function index(Request $request)
    {
        $search = $request->search;

        $data = Teacher::with('subject')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('subject', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            })
        ->paginate(10)
        ->withQueryString();

        $subject = Subject::doesntHave('teacher')->get();

        return view('admin.teacher', [
            'title' => 'Data Teacher',
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
        
        return \redirect()->route('admin.teacher.index');
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
        
        return \redirect()->route('admin.teacher.index');
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

        return \redirect()->route('admin.teacher.index');
    }
}
