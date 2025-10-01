<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        // $data = [
        //     [
        //         'nama' => "Raden Adika Ruzain Malasi",
        //         'email' => "raden@smkrus.sch.id",
        //         'alamat' => "Banten",
        //         'kelas' => "11 RPL 1"
        //     ],
        //     [
        //         'nama' => "Ihsan Hilmi Ubaidillah",
        //         'email' => "ihsan@smkrus.sch.id",
        //         'alamat' => "Depok",
        //         'kelas' => "11 RPL 1"
        //     ],
        //     [
        //         'nama' => "Azka El Fachrizy",
        //         'email' => "azka@gmail.com",
        //         'alamat' => "Kudus",
        //         'kelas' => "11 RPL 1"
        //     ],
        //     [
        //         'nama' => "Dhiaz Al Marwan",
        //         'email' => "dhiaz@gmail.com",
        //         'alamat' => "Nigeria",
        //         'kelas' => "11 RPL 1"
        //     ],
        //     [
        //         'nama' => "Zaky Arya Adinata Al Fonso",
        //         'email' => "zaky@niger.com",
        //         'alamat' => "Ngawi Selatan", 
        //         'kelas' => "11 RPL 10"
        //     ]
        //     ];

        $students = Student::all();

        return \view('datasiswa', [
            'title' => "Data Siswa",
            'data' => $students,
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
