<?php

namespace App\Http\Controllers;

use App\Models\ItemServies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServisBarangController extends Controller
{
    public function tambahServisBarang(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'id_barang' => 'required',
            'jumlah_barang' => 'required|numeric',
            'kondisi_barang' => 'required',
            'tgl_masuk' => 'required',
            'tgl_servis' => 'required',
            'tgl_keluar' => 'required',
            'status_servis' => 'required',
            'jenis_servis' => 'required',
            'harga_servis' => 'required|numeric',
            'keterangan' => 'required',
        ]);


        if ($validator->validate()) {
            $items = ItemServies::create($request->all());

            return redirect('/admin/servis-barang')->with([
                'success' => 'Berhasil Menambahkan Data Servis Barang'
            ]);
        } else {
            return back()->with([
                'error' => 'Gagal Memproses Data Servis Barang'
            ]);
        }
    }

    public function ubahServisBarang(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'id_barang' => 'required',
            'jumlah_barang' => 'required|numeric',
            'kondisi_barang' => 'required',
            'tgl_masuk' => 'required',
            'tgl_servis' => 'required',
            'tgl_keluar' => 'required',
            'status_servis' => 'required',
            'jenis_servis' => 'required',
            'harga_servis' => 'required|numeric',
            'keterangan' => 'required',
        ]);


        if ($validator->validate()) {
            $item = ItemServies::find($id);

            if (!$item) {
                return back()->with([
                    'error' => 'Tidak dapat menemukan data Servis Barang'
                ]);
            }

            $item->update($request->all());

            return redirect('/admin/servis-barang')->with([
                'success' => 'Berhasil Mengubah Data Servis Barang'
            ]);
        } else {
            return back()->with([
                'error' => 'Gagal Memproses Data Servis Barang'
            ]);
        }
    }

    public function hapusServisBarang($id = null)
    {
        $item = ItemServies::find($id);

        if (!$item) {
            return back()->with([
                'error' => 'Tidak dapat menemukan data Servis Barang, Silahkan Input Servis Barang Baru.'
            ]);
        }

        if ($item->delete()) {
            return redirect('/admin/servis-barang')->with([
                'success' => 'Berhasil Menghapus Data Servis Barang'
            ]);
        } else {
            return back()->with([
                'error' => 'Gagal Menghapus Data Servis Barang'
            ]);
        }
    }
}
