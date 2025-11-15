<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardians extends Model
{
    /** @use HasFactory<\Database\Factories\GuardiansFactory> */
    use HasFactory;
    protected $fillable = ['name', 'job', 'phone', 'email'];
}
