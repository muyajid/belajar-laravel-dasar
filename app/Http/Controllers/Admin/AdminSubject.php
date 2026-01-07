<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class AdminSubject extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $data = Subject::with('teacher')->get();

        // return \view('admin.subject', [
        //     'title' => "Data Subject",
        //     'subject' => $data
        // ]);
        
        $search = $request->search;

        $data = Subject::with('teacher')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })->paginate(10)->withQueryString();
        
        return \view('admin.subject', [
            'title' => "Data Subject",
            'subject' => $data
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
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        Subject::create($validasi);

        return \redirect()->route('admin.subject.index');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $subject = Subject::findOrFail($id);

        $validasi = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:2255'
        ]);
        
        $subject->update([
            'name' => $validasi['name'],
            'description' => $validasi['description']
        ]);

        return redirect()->route('admin.subject.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
