<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageUserController extends Controller
{
    public function form($id = null)
    {
        $employees = Employee::leftJoin('users', 'users.id_pegawai', '=', 'employees.id')->where('users.id_pegawai', $id)->get(['employees.*']);

        $data = [
            'employees' => $employees,
        ];

        if ($id != null) {
            $pegawai  = User::where('id_pegawai', $id)->first();
            $data['pegawai'] = $pegawai;
        }

        return view('admin.form-manage-user', $data);
    }

    public function list()
    {
        $employees = Employee::leftJoin('users', 'users.id_pegawai', '=', 'employees.id')
            ->where('employees.divisi', 1)
            ->get(['users.*', 'employees.nama', 'employees.nip', 'employees.gol', 'employees.jabatan', 'employees.pimpinan']);

        $data = [
            'employees' => $employees
        ];

        return view('admin.list-manage-user', $data);
    }

    public function pegawai($id = null)
    {
        $employee = null;

        if ($id != null) {
            $employee = Employee::find($id);

            if (!$employee) {
                return redirect('/manage/pegawai')->with([
                    'error' => 'Tidak dapat menemukan Data Pegawai',
                ]);
            }
        }

        $employees = Employee::where('divisi', 1)->get();

        $data = [
            'employees' => $employees,
            'employee' => $employee,
            'employee_id' => $id,
            'jk' => ['Laki - Laki', 'Perempuan'],
            'status' => ['Kontrak', 'Honor', 'PNS'],
        ];

        return view("admin.pegawai", $data);
    }

    public function manage(Request $request)
    {
        $request->validate([
            'pegawai' => 'required',
            'username' => 'required|alpha_num|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'konfirmasiPassword' => 'required|same:password',
        ], [
            'required' => ':attribute tidak boleh kosong.',
            'email' => ':attribute tidak boleh kosong.',
            'unique' => ':attribute sudah digunakan.',
            'same' => ':attribute tidak sama dengan :other.',
            'alpha_num' => ':attribute hanya berupa huruf dan angka.'
        ]);

        $employee = Employee::find($request->pegawai);

        if (!$employee) {
            return back()->with('error', 'Terjadi Kesalahan. Data Pegawai tidak ditemukan');
        }

        try {
            $input = [
                'name' => $employee->nama,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $employee->pimpinan == 1 ? 2 : 3,
                'id_pegawai' => $request->pegawai,
            ];

            User::create($input);

            return redirect('/manage/user-list')->with('success', 'Berhasil Menambah Akses User dari ' . $employee->nama);
        } catch (\Exception $th) {
            return redirect('/manage/user')->with('error', 'Terjadi Kesalahan. ' . $th->getMessage());
        }
    }

    public function deleteAccess($id)
    {
        $user = User::find($id);

        if ($user == null || $user->role == 1) {
            return redirect('/manage/user-list')->with('error', 'Terjadi Kesalahan. Tidak dapat menghapus access akun');
        }

        $user->delete();

        return redirect('/manage/user-list')->with('success', 'Berhasil menghapus access akun dari ' . $user->name);
    }
}
