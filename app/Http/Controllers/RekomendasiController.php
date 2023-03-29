<?php

namespace App\Http\Controllers;

use App\Models\Map;
use App\Models\Kategori;
use App\Models\Komoditas;
use App\Models\rekomendasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class rekomendasiController extends Controller
{
    public function datarekomendasi()
    {
        $data = new Map();
        $data_rekomendasi = $data->tampil();
        return view('dashboard/rekomendasi/data-rekomendasi', [
            'title' => 'Data rekomendasi',
            'komoditas' => Komoditas::all(),
            'rekomendasi' => $data_rekomendasi
        ]);
    }

    public function tambahdatarekomendasi()
    {
        $data = new Map();
        $data_rekomendasi = $data->tampil();
        return view('dashboard/rekomendasi/tambah-data-rekomendasi', [
            'title' => 'Tambah Data rekomendasi',
            'komoditas' => Komoditas::all(),
            'rekomendasi' => $data_rekomendasi,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'komoditas_id' => 'required'
        ]);


        $kategori = Komoditas::all();
        foreach ($kategori as $kat) {
            if ($kat->id == intval($validatedData['komoditas_id'])) {
                $validatedData['marker_image'] = $kat['foto'];
                $validatedData['url'] = 'detail-rekomendasi/' . $kat->id;
                $validatedData['title'] = $kat->nama;
            }
        }

        Rekomendasi::create($validatedData);

        $rekomendasi = Rekomendasi::all()->last();
        $data = new Map();
        $data->tambah($rekomendasi);

        return redirect('/dashboard/data-rekomendasi')->with('success', 'Data berhasil ditambahkan!');
    }

    public function delete($id)
    {
        // $data = rekomendasi::find($id);
        // $data->delete();
        $data = new Map();
        $data->hapus($id);

        return redirect('/dashboard/data-rekomendasi')->with('success', 'rekomendasi berhasil dihapus');
    }

    public function edit($id)
    {
        $rekomendasi = DB::table('rekomendasis')->where('id', $id)->first();
        return view('dashboard/rekomendasi/edit', [
            'title' => 'Edit Data rekomendasi',
            'rekomendasi' => $rekomendasi,
            'komoditas' => Komoditas::all()
        ]);
    }

    public function editdatarekomendasi(Request $request, $id)
    {
        $validatedData =  $request->validate([
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'komoditas_id' => 'required'
        ]);

        Rekomendasi::where('id', $id)->update($validatedData);
        $data = new Map();
        $data->edit($id, $validatedData);

        return redirect('/dashboard/data-rekomendasi')->with('success', 'rekomendasi berhasil diubah');
    }

    public function restore()
    {
        $data = new Map();
        $data = $data->tampil();
        foreach ($data as $dt) {
            Rekomendasi::create($dt);
        }
    }
}