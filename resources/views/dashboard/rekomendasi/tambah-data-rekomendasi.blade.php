@extends('dashboard.layout.main')

@section('container')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="page-title">Tambah Data rekomendasi</h2>
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong class="card-title">Form rekomendasi</strong>
                </div>
                <div class="card-body">
                    <form class="row" method="POST" action="/dashboard/tambah-data-rekomendasi">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="simpleinput">Nama Tempat</label>
                                <input type="text" id="address" name="address" value="{{ old('address') }}" class="form-control">
                                @error('address')
                                <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="simpleinput">latitude</label>
                                <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}" class="form-control">
                                @error('latitude')
                                <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="simpleinput">longitude</label>
                                <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}" class="form-control">
                                @error('longitude')
                                <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="komoditas_id">komoditas</label>
                                <select class="custom-select" id="komoditas_id" name="komoditas_id">
                                    <option >pilih</option>
                                    @foreach ($komoditas as $kat)
                                        <option value="{{ $kat['id'] }}">{{ $kat['nama'] }}</option>
                                    @endforeach
                                </select>
                                @error('komoditas_id')
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