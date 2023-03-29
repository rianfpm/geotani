@extends('dashboard.layout.main')

@section('container')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="page-title">Edit Data Video</h2>
            <p class="text-muted">Demo for form control styles, layout options, and custom components for
                creating a wide variety of forms.</p>
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong class="card-title">Form Video</strong>
                </div>
                <div class="card-body">
                    <form class="row" method="POST" action="/dashboard/data-video/{{ $video->id }}">
                        @csrf
                        @method('put')
                        <input type="text" name="id" id="id" value="{{ $video->id }}" hidden>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="simpleinput">Judul</label>
                                <input type="text" id="nama" name="nama" value="{{ $video->nama }}" class="form-control">
                                @error('nama')
                                <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="kategori_id">Kategori</label>
                                <select class="custom-select" id="kategori_id" name="kategori_id">
                                    <option>pilih</option>
                                    @foreach ($kategori as $kat)
                                        @if (intval($video->kategori_id)  == $kat['id'])
                                            <option value="{{ $kat['id'] }}" selected>{{ $kat['nama'] }}</option>
                                        @else
                                            <option value="{{ $kat['id'] }}">{{ $kat['nama'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <br>
                                <img class="img-preview img-fluid mb-3 col-sm-5" src="{{ asset('storage/'.$video->foto) }}">
                                <input class="form-control" type="file" id="foto" name="foto" onchange="previewImage()">
                                @error('foto')
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
                                        aria-describedby="video_link" name="video_link" value="{{ $video->video_link }}"
                                        @error('video-link')
                                            <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea id="deskripsi" class="form-control" name="deskripsi" rows="10" cols="50">{{ $video->deskripsi }}</textarea>
                                @error('deskripsi')
                                <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                @enderror
                            </div>

                            <button class="btn btn-primary" type="submit">Edit Data</button>
                        </div> 
                    </form>
                </div> <!-- / .card -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> 
</div>

@endsection