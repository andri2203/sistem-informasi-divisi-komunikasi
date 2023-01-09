<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index($id_berita = null)
    {

        $data = [
            'tipe' => ['Profil', 'Pengumuman'],
            'id_berita' => $id_berita,
            'news' => News::find($id_berita)
        ];

        return view('news.index', $data);
    }

    public function data()
    {
        $data = [
            'data' => News::get(),
        ];

        return view('news.list', $data);
    }

    public function tambah(Request $request)
    {
        $validated = $request->validate([
            'header' => 'required|max:255',
            'slug' => 'required',
            'type' => 'required',
            'image' => 'required|image|file|max:1024|mimes:jpg,png,jpeg,gif,svg',
            'body' => 'required',
        ]);


        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('news');
        }

        News::create($validated);

        return redirect('/admin/berita')->with([
            'success' => "Berhasil Menambahkan Post Baru"
        ]);
    }

    public function ubah(Request $request, $id)
    {
        $validated = $request->validate([
            'header' => 'required|max:255',
            'slug' => 'required',
            'type' => 'required',
            'image' => 'required|image|file|max:1024|mimes:jpg,png,jpeg,gif,svg',
            'body' => 'required',
        ]);

        $news = News::find($id);

        if (!$news) {
            return redirect('/admin/berita')->with([
                'error' => "Gagal Mengubah. Data Tidak ditemukan"
            ]);
        }

        if ($request->file('image')) {
            Storage::delete($news->image);
            $validated['image'] = $request->file('image')->store('news');
        }

        $news->update($validated);

        return redirect('/admin/berita')->with([
            'success' => "Berhasil Mengubah Post " . $news->header
        ]);
    }

    public function hapus($id)
    {
        $news = News::find($id);

        if (!$news) {
            return back()->with([
                'error' => "Gagal Menghapus. Data Tidak ditemukan"
            ]);
        }

        if ($news->image) {
            Storage::delete($news->image);
        }

        $news->delete();

        return redirect('/admin/berita')->with([
            'success' => "Berhasil Menghapus Post " . $news->header
        ]);
    }

    public function berita($slug)
    {
        $news = News::where('slug', $slug)->first();

        if (!$news) {
            return back();
        }

        $data = [
            'berita' => $news
        ];

        return view('user.berita', $data);
    }

    public function dashboard_pengumuman()
    {
        $type = "Pengumuman";

        $news = News::where('type', $type)->orderBy('created_at', 'desc')->get();

        $data = [
            'news' => $news,
            'title' => $type,
            'extends' => "layouts.dashboard",
            'section' => "dashboard",
        ];

        return view('user.tags', $data);
    }

    public function home_pengumuman()
    {
        $type = "Pengumuman";

        $news = News::where('type', $type)->orderBy('created_at', 'desc')->get();

        $data = [
            'news' => $news,
            'title' => $type,
            'extends' => "layouts.news",
            'section' => "news",
        ];

        return view('user.tags', $data);
    }
}
