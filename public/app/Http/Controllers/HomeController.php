<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $data = [
            'pimpinan' => Employee::where('pimpinan', 1)->first(),
            'profil' => News::where('type', "Profil")->get(),
            'pengumuman' => News::where('type', "Pengumuman")->offset(0)->limit(4)->orderBy('created_at', 'desc')->get(),
        ];

        return view("home.index", $data);
    }
}
