<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemStock extends Model
{
    use HasFactory;

    protected $table = 'item_stocks';

    protected $fillable = [
        'id_barang',
        'stock_barang',
        'jumlah_barang_bagus',
        'jumlah_barang_tidak_bagus',
        'keterangan',
    ];
}
