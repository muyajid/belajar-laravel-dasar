<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guardians;

class AdminGuardians extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $search = $request->search;

    $guardians = Guardians::query()
        ->when($search, function ($query) use ($search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
        })
        ->paginate(10) 
        ->withQueryString();

    return view('admin.guardians', [
        'title' => 'Data Guardians',
        'guardians' => $guardians
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'name' => 'required|string',
            'job' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email|unique:guardians,email',
        ]);

        Guardians::create([
            'name' => $validasi['name'],
            'job' => $validasi['job'],
            'phone' => $validasi['phone'],
            'email' => $validasi['email']
        ]);

        return \redirect()->route('admin.guardians.index');
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
        $guardians = Guardians::findOrFail($id);

        $validasi = $request->validate([
            'name' => 'required|string',
            'job' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email|unique:guardians,email,' . $id,
        ]);

        $guardians->update($validasi);
        return \redirect()->route('admin.guardians.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guardians = Guardians::findOrFail($id);
        $guardians->delete();
        return \redirect()->route('admin.guardians.index');
    }
}
