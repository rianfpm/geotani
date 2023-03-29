@extends('dashboard.layout.main')

@section('container')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="page-title">Tambah Data Video</h2>
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong class="card-title">Form Video</strong>
                </div>
                <div class="card-body">
                    <form class="row" method="POST" action="/dashboard/tambah-data-video" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="simpleinput">Judul</label>
                                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="form-control">
                                @error('nama')
                                <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="kategori_id">Kategori</label>
                                <select class="custom-select" id="kategori_id" name="kategori_id">
                                    <option >pilih</option>
                                    @foreach ($kategori as $kat)
                                        <option value="{{ $kat['id'] }}">{{ $kat['nama'] }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="video-link">Video</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            id="video-link">https://youtube.com/</span>
                                    </div>
                                    <input type="text" class="form-control" id="video_link"
                                        aria-describedby="video_link" name="video_link"
                                        @error('video_link')
                                        <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <img class="img-preview img-fluid mb-3 col-sm-5">
                                <input class="form-control" type="file" id="foto" name="foto" onchange="previewImage()">
                                @error('foto')
                                <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea  value="{{ old('deskripsi') }}" id="deskripsi" class="form-control" name="deskripsi" rows="10" cols="50"></textarea>
                                @error('deskripsi')
                                <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                @enderror
                            </div>

                            <button class="btn btn-primary" type="submit">Tambah Data</button>
                        </div> 
                    </form>
                </div> <!-- / .card -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> 
</div>

@endsection