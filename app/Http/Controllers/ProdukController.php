<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    protected $guarded = ['id'];

    public function index()
    {
        return view('belanja', [
            'title' => 'Belanja',
            'produk' => Produk::latest()->filter(request((['search'])))->get(),
        ]);
    }

    public function dataproduk()
    {
        return view('dashboard.produk.dataproduk', [
            'title' => 'Data produk',
            'produk' => Produk::with(['kategori'], ['user'])->latest()->get(),
        ]);
    }

    public function tambahdataproduk()
    {
        return view('dashboard.produk.tambah-data-produk', [
            'title' => 'Data Video',
            'kategori' => Kategori::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'kategori_id' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|file|max:10240',
            'harga' => 'required',
            'berat' => 'required',
            'stok' => 'required'
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('foto-produk');
        }

        Produk::create($validatedData);

        return redirect('/dashboard/data-produk')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $produk = DB::table('produks')->where('id', $id)->first();

        return view('dashboard/produk/edit', [
            'title' => 'Edit Data produk',
            'produk' => $produk,
            'kategori' => Kategori::all(),
        ]);
    }

    public function editdataproduk(Request $request, $id)
    {

        $validatedData =  $request->validate([
            'nama' => 'required|max:255',
            'kategori_id' => 'required',
            'deskripsi' => 'required',
            'foto' => 'file',
            'stok' => 'required',
            'harga' => 'required',
            'berat' => 'required',
        ]);

        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('foto-produk');
        }


        Produk::where('id', $id)->update($validatedData);
        return redirect('/dashboard/data-produk')->with('success', 'produk berhasil diubah');
    }

    public function delete($id)
    {

        DB::table('produks')->where('id', $id)->delete();

        return redirect('/dashboard/data-produk')->with('success', 'produk berhasil dihapus');
    }

    public function detailproduk($id)
    {
        return view('/detail/detail-produk', [
            'title' => 'Detail produk',
            'produk' => Produk::where('id', $id)->first(),
            'user' => User::all(),
            'kategori' => Kategori::all(),
            'all' => Produk::all(),
        ]);
    }
}