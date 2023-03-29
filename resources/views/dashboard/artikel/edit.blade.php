@extends('dashboard.layout.main')



@section('container')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="page-title">Edit Data Artikel</h2>
            <p class="text-muted">Demo for form control styles, layout options, and custom components for
                creating a wide variety of forms.</p>
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong class="card-title">Form Artikel</strong>
                </div>
                <div class="card-body">
                    <form class="row" method="POST" action="/dashboard/data-artikel/{{ $artikel->id }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <input type="text" value="{{ $artikel->nama }}" hidden>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="simpleinput">Judul</label>
                                <input type="text" id="nama" name="nama" value="{{ $artikel->nama }}" class="form-control">
                                @error('nama')
                          <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                        @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="kategori_id">Kategori</label>
                                <select class="custom-select" id="kategori_id" name="kategori_id">
                                    <option >pilih</option>
                                    @foreach ($kategori as $kat)
                                        @if (intval($artikel->kategori_id) == intval($kat['id']))
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
                                <img class="img-preview img-fluid mb-3 col-sm-5" src="{{ asset('storage/'.$artikel->foto) }}">
                                <input class="form-control" type="file" id="foto" name="foto" onchange="previewImage()">
                                @error('foto')
                                    <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea id="deskripsi" class="form-control" name="deskripsi" rows="10" cols="50">{{  $artikel->deskripsi }}</textarea>
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