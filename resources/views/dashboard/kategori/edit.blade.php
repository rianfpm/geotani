@extends('dashboard.layout.main')

@section('container')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="page-title">Edit Data kategori</h2>
            <div class="card shadow mb-4">
                <div class="card-header">
                    <strong class="card-title">Form kategori</strong>
                </div>
                <div class="card-body">
                    <form class="row" method="POST" action="/dashboard/data-kategori/{{ $kategori->id }}">
                        @csrf
                        @method('put')
                        <input type="text" name="id" id="id" value="{{ $kategori->id }}" hidden>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="simpleinput">Nama Kategori</label>
                                <input type="text" id="nama" name="nama" value="{{ $kategori->nama }}" class="form-control">
                                @error('nama')
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