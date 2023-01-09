<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function changePassword(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'passwordLama' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('Password lama tidak cocok');
                }
            }],
            'passwordBaru' => ['required', function ($attribute, $value, $fail) {
                if (Hash::check($value, Auth::user()->password)) {
                    $fail('Password Baru tidak boleh sama dengan Password Lama');
                }
            }],
            'konfirmasiPassword' => 'required|same:passwordBaru',
        ]);

        if (!$validate->validate()) {
            return back();
        }

        $auth = Auth::user();
        $user = User::find($auth->id);
        $user->password = Hash::make($request->passwordBaru);
        $user->save();

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($auth->access == 'user') {
            return redirect('/auth/login')->with(['success' => 'Berhasil Merubah Password. Silahkan login kembali']);
        }

        return redirect('/admin/login')->with(['success' => 'Berhasil Merubah Password. Silahkan login kembali']);
    }

    public function loginForm()
    {
        $data = [
            'title' => "Masuk | User Bataliyon",
            "action" => "/auth/login",
            'btn_title' => "Masuk"
        ];

        return view('auth.login', $data);
    }

    public function registrasiForm()
    {
        $data = [
            'title' => "Daftar | User Bataliyon",
            "action" => "/auth/register",
            'btn_title' => "Daftar"
        ];

        return view('auth.register', $data);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->with([
            'error' => 'Username / Password salah atau Username tidak valid.',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users|alpha_num',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5',
            'konfirmasiPassword' => 'required|same:password',
        ]);

        $input = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 2,
        ];

        $user =  User::create($input);

        if ($user) {
            return redirect('/auth/login')->with([
                'success' => 'Akun anda berhasil didaftarkan. Silahkan login'
            ]);
        } else {
            return back()->with([
                'error' => 'Terjadi masalah saat menyimpan data User'
            ]);
        }
    }

    public function logout(Request $request)
    {
        $access = auth()->user()->access;

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/auth/login');
    }
}
