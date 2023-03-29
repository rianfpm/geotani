<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    protected $guarded = ['id'];

    public function datakategori()
    {
        return view('dashboard.kategori.data-kategori', [
            'title' => 'Data kategori',
            'kategori' => Kategori::all(),
        ]);
    }

    public function tambahdatakategori()
    {
        return view('dashboard/kategori/tambah-data-kategori', [
            'title' => 'Tambah Data kategori',
            'kategori' => Kategori::all()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'nama' => 'required|max:255'
        ]);

        Kategori::create($validatedData);

        return redirect('/dashboard/data-kategori')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kategori = DB::table('kategoris')->where('id', $id)->first();

        return view('dashboard/kategori/edit', [
            'title' => 'Edit Data kategori',
            'kategori' => $kategori
        ]);
    }

    public function editdatakategori(Request $request, $id)
    {
        $validatedData =  [
            'nama' => $request['nama'],
        ];

        kategori::where('id', $id)->update($validatedData);
        return redirect('/dashboard/data-kategori')->with('success', 'kategori berhasil diubah');
    }

    public function delete($id)
    {

        DB::table('kategoris')->where('id', $id)->delete();

        return redirect('/dashboard/data-kategori')->with('success', 'kategori berhasil dihapus');
    }
}