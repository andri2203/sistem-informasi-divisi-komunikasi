<?php

namespace App\Http\Controllers;

use App\Models\Employee;
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
            'id_barang' => null,
            'periode' => date("Y-m"),
            'is_data' => false,
            'items' => $items
        ];

        return view("admin.stok-barang", $data);
    }

    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'barang' => 'required',
            'periode' => 'required',
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

        $tanggal_mulai = $request->periode . "-1";
        $tanggal_akhir = date("Y-m-t", strtotime($tanggal_mulai));

        $barang = ItemModel::find($request->barang);
        $distribusi_barang = ItemDistribution::where([
            'id_barang' => $request->barang,
        ])->whereBetween('created_at', [$tanggal_mulai, $tanggal_akhir,])->get();

        $items = ItemModel::get();

        $data = [
            'id_barang' => $request->barang,
            'periode' => $request->periode,
            'items' => $items,
            'is_data' => true,
            'barang' => $barang,
            'distribusi' => $distribusi_barang
        ];

        return view("admin.stok-barang", $data);
    }

    public function cetak($id, $periode)
    {
        $tanggal_mulai = $periode . "-1";
        $tanggal_akhir = date("Y-m-t", strtotime($tanggal_mulai));

        $barang = ItemModel::find($id);
        $distribusi_barang = ItemDistribution::where([
            'id_barang' => $id,
        ])->whereBetween('created_at', [$tanggal_mulai, $tanggal_akhir,])->get();

        $items = ItemModel::get();
        $pimpinan = Employee::where('pimpinan', '1')->orderBy('created_at', 'desc')->first();

        $data = [
            'items' => $items,
            'is_data' => true,
            'barang' => $barang,
            'distribusi' => $distribusi_barang,
            'title' => 'Laporan Stok Barang',
            'pimpinan' => $pimpinan
        ];

        return view("admin.stok-barang-cetak", $data);
    }
}
