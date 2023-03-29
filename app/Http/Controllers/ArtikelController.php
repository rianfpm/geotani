<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ArtikelController extends Controller
{

    public function index()
    {
        return view('artikel', [
            'title' => 'Artikel',
            'artikel' => Artikel::with(['kategori'])->latest()->filter(request((['search'])))->get(),
        ]);
    }


    public function dataartikel()
    {
        return view('dashboard/artikel/data-artikel', [
            'title' => 'Data artikel',
            'artikel' => Artikel::with(['kategori'], ['user'])->latest()->get(),
        ]);
    }

    public function tambahdataartikel()
    {
        return view('dashboard/artikel/tambah-data-artikel', [
            'title' => 'Tambah Data artikel',
            'kategori' => Kategori::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'nama' => 'required|max:255',
            'kategori_id' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|file|mimes:jpeg,bmp,png'
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('foto-artikel');
        }


        Artikel::create($validatedData);

        return redirect('/dashboard/data-artikel')->with('success', 'Data berhasil ditambahkan!');
    }

    public function delete($id)
    {
        // $data = Artikel::find($id);
        // $data->delete();

        DB::table('artikels')->where('id', $id)->delete();

        return redirect('/dashboard/data-artikel')->with('success', 'Artikel berhasil dihapus');
    }

    public function edit($id)
    {
        $artikel = DB::table('artikels')->where('id', $id)->first();
        return view('dashboard/artikel/edit', [
            'title' => 'Edit Data artikel',
            'artikel' => $artikel,
            'kategori' => Kategori::all()
        ]);
    }

    public function editdataartikel(Request $request, $id)
    {
        $validatedData =  $request->validate([
            'nama' => 'required|max:255',
            'kategori_id' => 'required',
            'deskripsi' => 'required',
            'foto' => 'file'
        ]);

        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('foto-artikel');
        }

        Artikel::where('id', $id)->update($validatedData);
        return redirect('/dashboard/data-artikel')->with('success', 'Artikel berhasil diubah');
    }

    public function detailartikel($id)
    {
        return view('/detail/detail-artikel', [
            'title' => 'Detail artikel',
            'artikel' => Artikel::with(['kategori'], ['user'])->where('id', $id)->first(),
            'all' => Artikel::with(['kategori'], ['user'])->latest()->get(),
        ]);
    }
}