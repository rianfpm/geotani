<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    protected $guarded = ['id'];

    public function index()
    {
        return view('video', [
            'title' => 'Video',
            'kategori' => Kategori::all(),
            'video' => Video::latest()->filter(request((['search'])))->get(),
        ]);
    }


    public function datavideo()
    {
        return view('dashboard.video.data-video', [
            'title' => 'Data Video',
            'video' => Video::latest()->get(),
            'kategori' => Kategori::all(),
            'user' => User::all()
        ]);
    }

    public function tambahdatavideo()
    {
        return view('dashboard/video/tambah-data-video', [
            'title' => 'Tambah Data Video',
            'kategori' => Kategori::all(),
            'video' => Video::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'nama' => 'required|max:255',
            'kategori_id' => 'required',
            'deskripsi' => 'required',
            'video_link' => 'required',
            'foto' => 'image|file|mimes:jpeg,bmp,png'
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('foto-video');
        }

        Video::create($validatedData);

        return redirect('/dashboard/data-video')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $video = DB::table('videos')->where('id', $id)->first();

        return view('dashboard/video/edit', [
            'title' => 'Edit Data video',
            'video' => $video,
            'kategori' => Kategori::all(),
        ]);
    }

    public function editdatavideo(Request $request, $id)
    {
        $validatedData =  [
            'nama' => $request['nama'],
            'kategori_id' => $request['kategori_id'],
            'deskripsi' => $request['deskripsi'],
            'video_link' => $request['video_link']
        ];

        $validatedData['user_id'] = auth()->user()->id;

        Video::where('id', $id)->update($validatedData);
        return redirect('/dashboard/data-video')->with('success', 'Video berhasil diubah');
    }

    public function delete($id)
    {

        DB::table('videos')->where('id', $id)->delete();

        return redirect('/dashboard/data-video')->with('success', 'Video berhasil dihapus');
    }

    public function detailvideo($id)
    {
        $video = Video::where('id', $id)->first();
        $link = new Video;
        $link = $link->parseURL($video->video_link);

        return view('/detail/detail-video', [
            'title' => 'Detail Video',
            'video' => $video,
            'link' => $link,
            'user' => User::all(),
            'kategori' => Kategori::all(),
            'all' => Video::all(),
        ]);
    }
}