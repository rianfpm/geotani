@extends('dashboard.layout.main')

@section('container')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="page-title">Tambah Data Kategori</h2>
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong class="card-title">Form Kategori</strong>
                </div>
                <div class="card-body">
                    <form class="row" method="POST" action="/dashboard/tambah-data-kategori">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="simpleinput">Nama Kategori</label>
                                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="form-control">
                                @error('nama')
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