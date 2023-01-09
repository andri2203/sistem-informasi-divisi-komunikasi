<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\UploadFile;
use Illuminate\Http\Request;

class UploadedFileController extends Controller
{
    public function index()
    {
        $employee = Employee::find(auth()->user()->id_pegawai);
        $files = UploadFile::where('id_pegawai', auth()->user()->id_pegawai)->get();

        $data = [
            'employee' => $employee,
            'files' => $files,
        ];

        return view("user.list-files", $data);
    }

    public function form($id = null)
    {
        $employee = Employee::find(auth()->user()->id_pegawai);

        $data = [
            'title' => 'Upload File',
            'active' => 'upload',
            'employee' => $employee,
            'file' => null,
            'id_file' => $id,
        ];

        if ($id != null) {
            $file = UploadFile::find($id);
            $data['file'] = $file;
        }

        return view("user.upload-file", $data);
    }

    public function upload(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:doc,docx,xls,xlsx,pdf',
            'keterangan' => 'required|max:250',
        ]);

        $validated['id_pegawai'] = auth()->user()->id_pegawai;

        try {
            $reqFile = $request->file('file');
            $name    = $reqFile->getClientOriginalName();
            $path    = $request->file('file')->storeAs('files', $name);

            $validated['file'] = $path;

            UploadFile::create($validated);

            return redirect('/upload_file')->with('success', 'Berhasil Menambah Data Files');
        } catch (\Exception $th) {
            return back()->with([
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'file' => 'file|mimes:doc,docx,xls,xlsx,pdf',
            'keterangan' => 'required|max:250',
        ]);

        $file = UploadFile::find($id);

        if (!$file) {
            return back()->with('error', 'Data File Tidak Ditemukan');
        }

        $validated['id_pegawai'] = auth()->user()->id_pegawai;

        try {
            if ($request->file('file')) {
                $reqFile = $request->file('file');
                $name    = $reqFile->getClientOriginalName();
                $path    = $request->file('file')->storeAs('files', $name);
                $validated['file'] = $path;
            } else {
                $validated['file'] = $file->file;
            }

            $file->update($validated);

            return redirect('/upload_file')->with('success', 'Berhasil Mengubah Data Files');
        } catch (\Exception $th) {
            return back()->with([
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function delete($id)
    {
        $file = UploadFile::find($id);

        if (!$file) {
            return back()->with('error', 'Data File Tidak Ditemukan');
        }

        $file->delete();

        return redirect('/upload_file')->with('success', 'Berhasil Menghapus Data Files');
    }
}
