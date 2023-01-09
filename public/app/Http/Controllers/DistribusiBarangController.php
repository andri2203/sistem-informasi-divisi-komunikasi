<?php

namespace App\Http\Controllers;

use App\Models\ItemDistribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistribusiBarangController extends Controller
{
    protected function input(Request $request, $status)
    {
        $formData = $request->all();
        $formData['status'] = $status;

        $distribusiBarang = ItemDistribution::create($formData);

        return $distribusiBarang;
    }

    protected function ubah(Request $request, $status, $id)
    {
        $distribusiBarang = ItemDistribution::where('status', $status)->find($id);

        if (!$distribusiBarang) return false;

        $formData = $request->all();
        $formData['status'] = $status;
        $distribusiBarang->update($formData);

        return true;
    }

    protected function hapus($status, $id)
    {
        $distribusiBarang = ItemDistribution::where('status', $status)->find($id);

        if (!$distribusiBarang) return false;

        $distribusiBarang->delete();

        return true;
    }

    public function inputBarangMasuk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_barang' => 'required',
            'jumlah_barang' => 'required|numeric',
            'kondisi_barang' => 'required',
            'tanggal' => 'required',
        ]);

        if ($validator->validate()) {
            if ($this->input($request, 'masuk')) {
                return redirect('/admin/barang-masuk')->with([
                    'success' => 'Berhasil Menambahkan Data Barang Masuk'
                ]);
            } else {
                return redirect('/admin/barang-masuk')->with([
                    'error' => 'Gagal Menambahkan Data Barang Masuk'
                ]);
            }
        } else {
            return back()->with([
                'error' => 'Gagal Memproses Data Barang Masuk'
            ]);
        }
    }

    public function inputBarangKeluar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_barang' => 'required',
            'jumlah_barang' => 'required|numeric',
            'kondisi_barang' => 'required',
            'tanggal' => 'required',
        ]);

        if ($validator->validate()) {
            if ($this->input($request, 'keluar')) {
                return redirect('/admin/barang-keluar')->with([
                    'success' => 'Berhasil Menambahkan Data Barang Keluar'
                ]);
            } else {
                return redirect('/admin/barang-keluar')->with([
                    'error' => 'Gagal Menambahkan Data Barang Keluar'
                ]);
            }
        } else {
            return back()->with([
                'error' => 'Gagal Memproses Data Barang Keluar'
            ]);
        }
    }

    public function ubahBarangMasuk(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_barang' => 'required',
            'jumlah_barang' => 'required|numeric',
            'kondisi_barang' => 'required',
            'tanggal' => 'required',
        ]);

        if ($validator->validate()) {
            if ($this->ubah($request, 'masuk', $id)) {
                return redirect('/admin/barang-masuk')->with([
                    'success' => 'Berhasil Mengubah Data Barang Masuk'
                ]);
            } else {
                return redirect('/admin/barang-masuk')->with([
                    'error' => 'Gagal Mengubah Data Barang Masuk'
                ]);
            }
        } else {
            return back()->with([
                'error' => 'Gagal Memproses Data Barang Masuk'
            ]);
        }
    }

    public function ubahBarangKeluar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_barang' => 'required',
            'jumlah_barang' => 'required|numeric',
            'kondisi_barang' => 'required',
            'tanggal' => 'required',
        ]);

        if ($validator->validate()) {
            if ($this->ubah($request, 'keluar', $id)) {
                return redirect('/admin/barang-keluar')->with([
                    'success' => 'Berhasil Mengubah Data Barang Keluar'
                ]);
            } else {
                return redirect('/admin/barang-keluar')->with([
                    'error' => 'Gagal Mengubah Data Barang Keluar'
                ]);
            }
        } else {
            return back()->with([
                'error' => 'Gagal Memproses Data Barang Keluar'
            ]);
        }
    }

    public function hapusBarangMasuk($id)
    {
        if ($this->hapus('masuk', $id)) {
            return redirect('/admin/barang-masuk')->with([
                'success' => 'Berhasil Menghapus Data Barang Masuk'
            ]);
        } else {
            return redirect('/admin/barang-masuk')->with([
                'error' => 'Gagal Menghapus Data Barang Masuk'
            ]);
        }
    }

    public function hapusBarangKeluar($id)
    {
        if ($this->hapus('keluar', $id)) {
            return redirect('/admin/barang-keluar')->with([
                'success' => 'Berhasil Menghapus Data Barang Keluar'
            ]);
        } else {
            return redirect('/admin/barang-keluar')->with([
                'error' => 'Gagal Menghapus Data Barang Keluar'
            ]);
        }
    }
}
