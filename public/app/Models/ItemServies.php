<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemServies extends Model
{
    use HasFactory;

    protected $table = 'item_servies';

    protected $fillable = [
        'id_barang',
        'jumlah_barang',
        'kondisi_barang',
        'tgl_masuk',
        'tgl_servis',
        'tgl_keluar',
        'status_servis',
        'jenis_servis',
        'harga_servis',
        'keterangan',
    ];
}
