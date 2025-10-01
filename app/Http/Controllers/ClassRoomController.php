<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassRoom;


class ClassRoomController extends Controller
{
    public function index()
    {
        //
        $data = ClassRoom::all();

        return \view("classroom", [
            'title' => "ClassRoom",
            'data' => $data,
        ]);
    }
}
