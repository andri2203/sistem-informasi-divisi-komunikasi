<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function tambah(Request $request)
    {
        $validate =  $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
            'gol' => 'required',
            'alamat' => 'required',
            'image' => 'required|image|file|max:1024|mimes:jpg,png,jpeg,gif,svg|',
        ]);

        try {
            if ($request->file('image')) {
                $file = $request->file('image')->store('user');

                $validate['image'] = $file;
            }

            Employee::create($validate);

            return redirect('/manage/pegawai')->with([
                'success' => 'Berhasil Menambahkan Data Pegawai',
            ]);
        } catch (\Exception $th) {
            return redirect('/manage/pegawai')->with([
                'error' => 'Gagal Menambahkan Data Pegawai ' . $th->getMessage(),
            ]);
        }
    }

    public function ubah(Request $request, $id)
    {
        $pegawai = Employee::find($id);

        if (!$pegawai) {
            return redirect('/manage/pegawai')->with([
                'error' => 'Tidak dapat menemukan Data Pegawai',
            ]);
        }

        $validate = $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
            'gol' => 'required',
            'alamat' => 'required',
            'image' => 'image|file|max:1024|mimes:jpg,png,jpeg,gif,svg|',
        ]);

        try {

            if ($request->file('image')) {
                if ($pegawai->image != null) {
                    Storage::delete($pegawai->image);
                }

                $file = $request->file('image')->store('user');
                $validate['image'] = $file;
            } else {
                $validate['image'] = $pegawai->image;
            }

            $validate['pimpinan'] = $request->pimpinan;


            $pegawai->update($validate);

            return redirect('/manage/pegawai')->with([
                'success' => 'Berhasil Mengubah Data Pegawai',
            ]);
        } catch (\Exception $th) {
            return redirect('/manage/pegawai')->with([
                'error' => 'Gagal Mengubah Data Pegawai ' . $th->getMessage(),
            ]);
        }
    }

    public function hapus($id)
    {
        $pegawai = Employee::find($id);

        if (!$pegawai) {
            return redirect('/manage/pegawai')->with([
                'error' => 'Tidak dapat menemukan Data Pegawai',
            ]);
        }

        $pegawai->delete();

        if ($pegawai) {
            return redirect('/manage/pegawai')->with([
                'success' => 'Berhasil Menghapus Data Pegawai',
            ]);
        } else {
            return redirect('/manage/pegawai')->with([
                'error' => 'Gagal Menghapus Data Pegawai',
            ]);
        }
    }
}
