<?php

namespace App\Http\Controllers;

use App\Models\ItemDistribution;
use App\Models\ItemModel;
use App\Models\ItemStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemStockController extends Controller
{
    public function index()
    {
        $items = ItemModel::get();
        $data = [
            'is_data' => false,
            'items' => $items
        ];

        return view("admin.stok-barang", $data);
    }

    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'barang' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_akhir' => 'required',
        ]);

        if ($request->tanggal_mulai > $request->tanggal_akhir) {
            return redirect("/admin/stok-barang")->with([
                'error' => "Tanggal awal tidak boleh lebih besar dari Tanggal Akhir"
            ]);
        }

        if (!$validate->validate()) {
            return redirect("/admin/stok-barang")->with([
                'error' => "Terjadi Kesalahan saat membaca inputan"
            ]);
        }

        $barang = ItemModel::find($request->barang);
        $distribusi_barang = ItemDistribution::where([
            'id_barang' => $request->barang,
        ])->whereBetween('created_at', [$request->tanggal_mulai, $request->tanggal_akhir,])->get();

        $items = ItemModel::get();

        $data = [
            'id_barang' => $request->barang,
            'items' => $items,
            'is_data' => true,
            'barang' => $barang,
            'distribusi' => $distribusi_barang
        ];

        return view("admin.stok-barang", $data);
    }
}
