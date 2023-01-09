<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BataliyonController extends Controller
{
    public function index()
    {
        $employee = Employee::where('id_user', auth()->user()->id)->first();

        $data = [
            'title' => 'Data Pribadi',
            'active' => 'profil',
            'jk' => ['Laki - Laki', 'Perempuan'],
            'status' => ['Kontrak', 'Honor', 'PNS'],
            'employee' => $employee,
        ];

        return view("user.profil", $data);
    }

    public function upload_file()
    {
        $employee = Employee::where('id_user', auth()->user()->id)->first();

        $data = [
            'title' => 'Upload File',
            'active' => 'upload',
            'employee' => $employee,
        ];

        return view("user.upload-file", $data);
    }

    public function informasi()
    {
        $employee = Employee::where('id_user', auth()->user()->id)->first();

        $data = [
            'title' => 'Informasi',
            'active' => 'informasi',
            'employee' => $employee,
        ];

        return view("user.informasi", $data);
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
        ]);

        try {
            $input = $request->all();

            $input['id_user'] = auth()->user()->id;

            Employee::create($input);

            return redirect('/bataliyon')->with('success', 'Berhasil Mengubah Data Pribadi');
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
        ]);

        try {
            $input = $request->all();

            $input['id_user'] = auth()->user()->id;

            $employee->update($input);

            return redirect('/bataliyon')->with('success', 'Berhasil Mengubah Data Pribadi');
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

            return redirect('/bataliyon')->with('success', 'Berhasil Mengubah Foto Profil');
        } catch (\Exception $th) {
            return back()->with([
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function uploaded_file(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:doc,docx,xls,xlsx,pdf',
            'keterangan' => 'required|max:250',
        ]);

        $employee = Employee::where('id_user', auth()->user()->id)->first();

        if (!$employee) {
            return back()->with([
                'error' => "Tidak dapat menemukan Data Pegawai. Mohon lengkapi Data Pribadi.",
            ]);
        }

        $validated['id_pegawai'] = $employee->id;

        try {
            $validated['file'] = $request->file('file')->store('files');

            UploadFile::create($validated);

            return redirect('/bataliyon/upload-file')->with('success', 'Berhasil Menambah Data Files');
        } catch (\Exception $th) {
            return back()->with([
                'error' => $th->getMessage(),
            ]);
        }
    }
}
