<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'nama',
        'email',
        'alamat',
        'class_rooms_id',
        'tanggal_lahir',
    ];


    public function classroom() {
        return $this->belongsTo(ClassRoom::class, 'class_rooms_id');
    }
}
