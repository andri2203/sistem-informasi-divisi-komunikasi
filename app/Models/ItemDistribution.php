<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDistribution extends Model
{
    use HasFactory;

    protected $table = 'item_distributions';

    protected $fillable = [
        'id_barang',
        'tanggal',
        'kondisi_barang',
        'jumlah_barang',
        'status',
    ];
}
