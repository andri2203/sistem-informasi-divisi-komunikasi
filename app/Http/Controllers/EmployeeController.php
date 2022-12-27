<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function tambah(Request $request)
    {
        $input = $request->all();

        $validate = Validator::make($input, [
            'nip' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
            'gol' => 'required',
            'alamat' => 'required',
        ]);

        if ($validate->validate()) {
            $pegawai = Employee::create($input);

            if ($pegawai) {
                return redirect('/admin/pegawai')->with([
                    'success' => 'Berhasil Menambahkan Data Pegawai',
                ]);
            } else {
                return redirect('/admin/pegawai')->with([
                    'error' => 'Gagal Menambahkan Data Pegawai',
                ]);
            }
        } else {
            return redirect('/admin/pegawai')->with([
                'error' => 'Gagal Menambahkan Data Pegawai',
            ]);
        }
    }

    public function ubah(Request $request, $id)
    {
        $input = $request->all();
        $pegawai = Employee::find($id);

        if (!$pegawai) {
            return redirect('/admin/pegawai')->with([
                'error' => 'Tidak dapat menemukan Data Pegawai',
            ]);
        }

        $validate = Validator::make($input, [
            'nip' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
            'gol' => 'required',
            'alamat' => 'required',
        ]);

        if ($validate->validate()) {
            $pegawai->update($input);

            if ($pegawai) {
                return redirect('/admin/pegawai')->with([
                    'success' => 'Berhasil Mengubah Data Pegawai',
                ]);
            } else {
                return redirect('/admin/pegawai')->with([
                    'error' => 'Gagal Mengubah Data Pegawai',
                ]);
            }
        } else {
            return redirect('/admin/pegawai')->with([
                'error' => 'Gagal Mengubah Data Pegawai',
            ]);
        }
    }

    public function hapus($id)
    {
        $pegawai = Employee::find($id);

        if (!$pegawai) {
            return redirect('/admin/pegawai')->with([
                'error' => 'Tidak dapat menemukan Data Pegawai',
            ]);
        }

        $pegawai->delete();

        if ($pegawai) {
            return redirect('/admin/pegawai')->with([
                'success' => 'Berhasil Menghapus Data Pegawai',
            ]);
        } else {
            return redirect('/admin/pegawai')->with([
                'error' => 'Gagal Menghapus Data Pegawai',
            ]);
        }
    }
}
