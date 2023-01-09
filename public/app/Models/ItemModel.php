<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemModel extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
        'kd_barang',
        'nm_barang',
        'mrk_barang',
        'jml_barang',
        'tahun_barang',
        'harga_barang',
        'keterangan',
    ];
}
