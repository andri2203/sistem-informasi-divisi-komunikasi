<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divition extends Model
{
    use HasFactory;

    protected $table = 'divitions';

    protected $fillable = ['name'];
}
