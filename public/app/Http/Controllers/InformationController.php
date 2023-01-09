<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformationController extends Controller
{
    private function form($dt = [])
    {
        $data = [
            'laporan' => [
                'Laporan Barang Masuk',
                'Laporan Barang Keluar',
                'Laporan Servis Barang',
            ],
        ];

        foreach ($dt as $key => $value) {
            $data[$key] = $value;
        }

        return view('user.informasi', $data);
    }

    public function index()
    {
        return $this->form();
    }

    public function show(Request $request)
    {
        $admin = new AdminController;
        $m = date('m', strtotime($request->periode));
        $y = date('Y', strtotime($request->periode));

        $data = [
            'data' => $admin->generateReport($request->laporan, $m, $y),
            'periode' => $request->periode,
            'indexLaporan' => $request->laporan,
            'bulan' => $m,
            'tahun' => $y,
        ];

        return $this->form($data);
    }

    public function cetak($laporan, $bulan, $tahun)
    {
        $admin = new AdminController;

        $lap = [
            'Laporan Barang Masuk',
            'Laporan Barang Keluar',
            'Laporan Servis Barang',
        ];

        $data = [
            'data' => $admin->generateReport($laporan, $bulan, $tahun),
            'periode' => $tahun . '-' . $bulan,
            'indexLaporan' => $laporan,
            'laporan' => $lap,
            'title' => $lap[$laporan],
        ];

        return view('user.cetak-informasi', $data);
    }
}
