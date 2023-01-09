<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'nama',
        'jk',
        'jabatan',
        'status',
        'gol',
        'divisi',
        'alamat',
        'pimpinan',
        'image',
    ];
}
