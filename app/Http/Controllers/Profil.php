<?php

namespace App\Http\Controllers;

use App\Models\Divition;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Profil extends Controller
{
    public function index()
    {
        $employee = Employee::find(auth()->user()->id_pegawai);
        $divisi = auth()->user()->role==1? Divition::get() : Divition::where('role', auth()->user()->role)->get();

        $data = [
            'employee' => $employee,
            'divisi' => $divisi,
            'jk' => ['Laki - Laki', 'Perempuan'],
            'status' => ['Kontrak', 'Honor', 'PNS'],
        ];

        return view("profil.index", $data);
    }

    public function gantiPassword()
    {
        return view("profil.ganti-password");
    }

    public function tambah_profil(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:employees',
            'nama' => 'required',
            'jk' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
            'gol' => 'required',
            'alamat' => 'required',
            'divisi' => 'required',
        ]);

        try {
            $input = $request->all();
            $user = User::find(auth()->user()->id);
            $pegawai = Employee::create($input);
            $user->id_pegawai = $pegawai->id;
            $user->save();

            return redirect('/profil')->with('success', 'Berhasil Mengubah Data Pribadi');
        } catch (\Exception $th) {
            return back()->with([
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function ubah_profil(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return back()->with([
                'error' => "Tidak dapat menemukan Data Pegawai.",
            ]);
        }

        $request->validate([
            'nip' => 'required|unique:employees,nip,' . $employee->id,
            'nama' => 'required',
            'jk' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
            'gol' => 'required',
            'alamat' => 'required',
            'divisi' => 'required',
        ]);

        try {
            $input = $request->all();
            $employee->update($input);

            return redirect('/profil')->with('success', 'Berhasil Mengubah Data Pribadi');
        } catch (\Exception $th) {
            return back()->with([
                'error' => $th->getMessage(),
            ]);
        }
    }
    public function ubah_foto(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|file|max:1024|mimes:jpg,png,jpeg,gif,svg|',
        ]);

        $employee = Employee::find($id);

        if (!$employee) {
            return back()->with([
                'error' => "Tidak dapat menemukan Data Pegawai.",
            ]);
        }

        try {
            if ($employee->image != null) {
                Storage::delete($employee->image);
            }

            $file = $request->file('image')->store('user');

            $employee->update(['image' => $file]);

            return redirect('/profil')->with('success', 'Berhasil Mengubah Foto Profil');
        } catch (\Exception $th) {
            return back()->with([
                'error' => $th->getMessage(),
            ]);
        }
    }
}
