<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ItemDistribution;
use App\Models\ItemModel;
use App\Models\ItemServies;
use App\Models\ItemStock;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    // Views

    public function index()
    {
        return view("admin.beranda");
    }

    public function barang($id = null)
    {
        $item = null;
        $items = ItemModel::get();

        if ($id != null) {
            $item = ItemModel::find($id);

            if (!$item) {
                return redirect('/admin/barang')->with([
                    'error' => 'Tidak dapat menemukan data barang'
                ]);
            }
        }


        $data = [
            'id_barang' => $id,
            'item' => $item,
            'items' => $items
        ];

        return view("admin.barang", $data);
    }

    public function servisBarang($id = null)
    {
        $items = ItemModel::get();
        $itemServis = null;

        if ($id != null) {
            $itemServis = ItemServies::find($id);

            if (!$itemServis) {
                return redirect('/admin/servis-barang')->with([
                    'error' => 'Tidak dapat menemukan data Servis Barang'
                ]);
            }
        }

        $data = [
            'id_servis_barang' => $id,
            'items' => $items,
            'itemServis' => $itemServis,
        ];

        return view("admin.servis-barang", $data);
    }

    public function barangMasuk($id = null)
    {
        $items = ItemModel::get();
        $distribusiBarang = null;

        if ($id != null) {
            $distribusiBarang = ItemDistribution::where('status', 'masuk')->find($id);

            if (!$distribusiBarang) {
                return redirect('/admin/barang-masuk')->with([
                    'error' => 'Tidak dapat menemukan data Barang Masuk'
                ]);
            }
        }

        $data = [
            'id_distribusi_barang' => $id,
            'items' => $items,
            'distribusiBarang' => $distribusiBarang
        ];

        return view("admin.barang-masuk", $data);
    }

    public function barangKeluar($id = null)
    {
        $items = ItemModel::get();
        $distribusiBarang = null;

        if ($id != null) {
            $distribusiBarang = ItemDistribution::where('status', 'keluar')->find($id);

            if (!$distribusiBarang) {
                return redirect('/admin/barang-keluar')->with([
                    'error' => 'Tidak dapat menemukan data Barang Keluar'
                ]);
            }
        }

        $data = [
            'id_distribusi_barang' => $id,
            'items' => $items,
            'distribusiBarang' => $distribusiBarang
        ];

        return view("admin.barang-keluar", $data);
    }

    public function pegawai($id = null)
    {
        $employee = null;

        if ($id != null) {
            $employee = Employee::find($id);

            if (!$employee) {
                return redirect('/admin/pegawai')->with([
                    'error' => 'Tidak dapat menemukan Data Pegawai',
                ]);
            }
        }

        $employees = Employee::get();

        $data = [
            'employees' => $employees,
            'employee' => $employee,
            'employee_id' => $id,
            'jk' => ['Laki - Laki', 'Perempuan'],
        ];

        return view("admin.pegawai", $data);
    }

    public function laporan(Request $request)
    {
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
        ];

        $data = [
            'bulan' => $bulan,
            'showTables' => false,
            'laporan' => [
                'Laporan Barang Masuk',
                'Laporan Barang Keluar',
                'Laporan Servis Barang',
            ],
            'id_laporan' => null,
            'id_bulan' => null,
            'id_tahun' => null,
        ];

        if ($request->isMethod("POST")) {
            $validate = Validator::make($request->all(), [
                'laporan' => 'required',
                'bulan' => 'required',
                'tahun' => 'required',
            ]);

            if ($validate->fails()) {
                return redirect('/admin/laporan')->with([
                    'error' => "Tidak dapat menampilkan data",
                ]);
            }

            $data['showTables'] = true;
            $data['data'] = $this->generateReport($request->laporan, $request->bulan, $request->tahun);
            $data['id_laporan'] = $request->laporan;
            $data['id_bulan'] = $request->bulan;
            $data['id_tahun'] = $request->tahun;

            // dd($data['data']);
        }

        return view("admin.laporan", $data);
    }

    public function cetakLaporanBulanan($id_laporan, $id_bulan, $id_tahun)
    {
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
        ];

        $laporan = [
            'Laporan Barang Masuk',
            'Laporan Barang Keluar',
            'Laporan Servis Barang',
        ];

        $pimpinan = Employee::where('pimpinan', '1')->orderBy('created_at', 'desc')->first();

        $data = [
            'bulan' => $bulan,
            'showTables' => false,
            'title' => $laporan[$id_laporan],
            'data' => $this->generateReport($id_laporan, $id_bulan, $id_tahun),
            'pimpinan' => $pimpinan,
        ];

        return view("admin.laporan-cetak", $data);
    }

    protected function generateReport($laporan, $bulan, $tahun)
    {
        $fromDate = new DateTime($tahun . "-" . ($bulan + 1) . "-01");
        $toDate = $fromDate->format("Y-m-t");

        switch ($laporan) {
            case '0': // Laporan Barang Masuk
                $dataBarangMasuk = ItemDistribution::join('items', 'items.id', '=', 'item_distributions.id_barang')
                    ->whereBetween('item_distributions.created_at', [$fromDate, $toDate])
                    ->where('item_distributions.status', 'masuk')->get([
                        'item_distributions.*',
                        'items.kd_barang',
                        'items.nm_barang',
                        'items.mrk_barang',
                        'items.tahun_barang',
                        'items.keterangan',
                    ]);

                $data = [
                    'head' => ['Kode Barang', "Nama Barang", "Merek", "Kondisi", "Tahun", "Jumlah Barang", "Tanggal Masuk", "Keterangan"],
                    'body' => []
                ];

                foreach ($dataBarangMasuk as $d) {
                    $row = [
                        $d->kd_barang,
                        $d->nm_barang,
                        $d->mrk_barang,
                        $d->kondisi_barang,
                        $d->tahun_barang,
                        $d->jumlah_barang,
                        date("d M Y", strtotime($d->tanggal)),
                        $d->keterangan,
                        ["/admin/barang-masuk/$d->id", "/admin/barang-masuk/hapus/$d->id"],
                    ];

                    array_push($data['body'], $row);
                }

                return $data;
                break;
            case '1': // Laporan Barang Keluar
                $dataBarangKeluar = ItemDistribution::join('items', 'items.id', '=', 'item_distributions.id_barang')
                    ->whereBetween('item_distributions.created_at', [$fromDate, $toDate])
                    ->where('item_distributions.status', 'keluar')->get([
                        'item_distributions.*',
                        'items.kd_barang',
                        'items.nm_barang',
                        'items.mrk_barang',
                        'items.tahun_barang',
                        'items.keterangan',
                    ]);
                $data = [
                    'head' => ['Kode Barang', "Nama Barang", "Merek", "Kondisi", "Tahun", "Jumlah Barang", "Tanggal Keluar", "Keterangan"],
                    'body' => [],
                ];

                foreach ($dataBarangKeluar as $d) {
                    $row = [
                        $d->kd_barang,
                        $d->nm_barang,
                        $d->mrk_barang,
                        $d->kondisi_barang,
                        $d->tahun_barang,
                        $d->jumlah_barang,
                        date("d M Y", strtotime($d->tanggal)),
                        $d->keterangan,
                        ["/admin/barang-keluar/$d->id", "/admin/barang-keluar/hapus/$d->id"],
                    ];

                    array_push($data['body'], $row);
                }

                return $data;
                break;
            case '2': // Laporan Servis Barang
                $dataServisBarang = ItemServies::join('items', 'items.id', '=', 'item_servies.id_barang')
                    ->whereBetween('item_servies.created_at', [$fromDate, $toDate])
                    ->get([
                        'item_servies.*',
                        'items.kd_barang',
                        'items.nm_barang',
                        'items.mrk_barang',
                        'items.tahun_barang',
                    ]);
                $data = [
                    'head' => [
                        'Kode Barang',
                        "Nama Barang",
                        "Merek",
                        "Kondisi",
                        "Tahun",
                        "Jumlah",
                        "Tanggal Masuk",
                        "Tanggal Servis",
                        "Tanggal Keluar",
                        "Status Servis",
                        "Jenis Servis",
                        "Harga Servis",
                        "Keterangan"
                    ],
                    'body' => [],
                ];

                foreach ($dataServisBarang as $d) {
                    $row = [
                        $d->kd_barang,
                        $d->nm_barang,
                        $d->mrk_barang,
                        $d->kondisi_barang,
                        $d->tahun_barang,
                        $d->jumlah_barang,
                        date("d M Y", strtotime($d->tgl_masuk)),
                        date("d M Y", strtotime($d->tgl_servis)),
                        date("d M Y", strtotime($d->tgl_keluar)),
                        $d->status_servis,
                        $d->jenis_servis,
                        'Rp.' . number_format($d->harga_servis, 2, ',', '.'),
                        $d->keterangan,
                        ["/admin/servis-barang/$d->id", "/admin/servis-barang/hapus/$d->id"],
                    ];

                    array_push($data['body'], $row);
                }

                return $data;
                break;
        }
    }

    public function login()
    {
        return view("admin.login-admin");
    }

    public function gantiPassword()
    {
        return view("admin.ganti-password");
    }

    // Logical

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email' => 'Email harus berupa valid email'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('admin');
        }

        return back()->with([
            'loginError' => 'Email atau password salah'
        ]);
    }
}
