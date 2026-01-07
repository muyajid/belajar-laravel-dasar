<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassRoom;

class AdminClassroom extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $data = ClassRoom::all();
        // return \view('admin.classroom', [
        //     'title' => 'Data Classroom',
        //     'classroom' => $data
        // ]);

        $search = $request->search;

        $data = ClassRoom::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })->paginate(10)->withQueryString();
        
        return \view('admin.classroom', [
            'title' => 'Data Classroom',
            'classroom' => $data
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
            'name_input' => 'required|string|max:255'
        ]);
        ClassRoom::create([
            'name' => $validasi['name_input']
        ]);

        return redirect()->route('admin.classroom.index');
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
        $classroom = ClassRoom::findOrFail($id);

        $validasi = $request->validate([
            'name_input' => 'required|string|max:255'
        ]);
        
        $classroom->update([
            'name' => $validasi['name_input']
        ]);

        return redirect()->route('admin.classroom.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
