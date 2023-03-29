@extends('dashboard.layout.main')

@section('container')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="page-title">Tambah Data komoditas</h2>
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong class="card-title">Form komoditas</strong>
                </div>
                <div class="card-body">
                    <form class="row" method="POST" action="/dashboard/tambah-data-komoditas">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="simpleinput">Nama</label>
                                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="form-control">
                                @error('nama')
                                <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="simpleinput">tinggi</label>
                                <input type="text" id="tinggi" name="tinggi" value="{{ old('tinggi') }}" class="form-control">
                                @error('tinggi')
                                <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="simpleinput">ph</label>
                                <input type="text" id="ph" name="ph" value="{{ old('ph') }}" class="form-control">
                                @error('ph')
                                <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="simpleinput">jenistanah</label>
                                <input type="text" id="jenistanah" name="jenistanah" value="{{ old('jenistanah') }}" class="form-control">
                                @error('jenistanah')
                                <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="simpleinput">kelembaban</label>
                                <input type="text" id="kelembaban" name="kelembaban" value="{{ old('kelembaban') }}" class="form-control">
                                @error('kelembaban')
                                <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="simpleinput">suhu</label>
                                <input type="text" id="suhu" name="suhu" value="{{ old('suhu') }}" class="form-control">
                                @error('suhu')
                                <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="simpleinput">musim</label>
                                <input type="text" id="musim" name="musim" value="{{ old('musim') }}" class="form-control">
                                @error('musim')
                                <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="foto">Link Foto</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            id="foto">Link</span>
                                    </div>
                                    <input type="text" class="form-control" id="foto"
                                        aria-describedby="foto" name="foto"
                                        @error('foto')
                                        <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                        @enderror
                                </div>
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