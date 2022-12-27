<?php

namespace App\Http\Controllers;

use App\Models\ItemModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function tambahBarang(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'kd_barang' => 'required|unique:items',
            'nm_barang' => 'required',
            'mrk_barang' => 'required',
            'jml_barang' => 'required|numeric',
            'tahun_barang' => 'required|numeric',
            'harga_barang' => 'required|numeric',
            'keterangan' => 'required',
        ], [
            'unique' => 'Kode barang ini ":kd_barang" Sudah Ada.'
        ]);


        if ($validator->validate()) {
            $items = ItemModel::create($request->all());

            return redirect('/admin/barang')->with([
                'success' => 'Berhasil Menambahkan Data Barang'
            ]);
        } else {
            return back()->with([
                'error' => 'Gagal Memproses Data Barang'
            ]);
        }
    }

    public function ubahBarang(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'kd_barang' => 'required|unique:items,kd_barang,' . $id,
            'nm_barang' => 'required',
            'mrk_barang' => 'required',
            'jml_barang' => 'required|numeric',
            'tahun_barang' => 'required|numeric',
            'harga_barang' => 'required|numeric',
            'keterangan' => 'required',
        ], [
            'unique' => 'Kode barang ini ":kd_barang" Sudah Ada.'
        ]);


        if ($validator->validate()) {
            $item = ItemModel::find($id);

            if (!$item) {
                return back()->with([
                    'error' => 'Tidak dapat menemukan data barang'
                ]);
            }

            $item->update($request->all());

            return redirect('/admin/barang')->with([
                'success' => 'Berhasil Mengubah Data Barang'
            ]);
        } else {
            return back()->with([
                'error' => 'Gagal Memproses Data Barang'
            ]);
        }
    }

    public function hapusBarang($id = null)
    {
        $item = ItemModel::find($id);

        if (!$item) {
            return back()->with([
                'error' => 'Tidak dapat menemukan data barang, Silahkan Input Barang Baru.'
            ]);
        }

        if ($item->delete()) {
            return back()->with([
                'success' => 'Berhasil Menghapus Data Barang'
            ]);
        } else {
            return back()->with([
                'error' => 'Gagal Menghapus Data Barang'
            ]);
        }
    }
}
