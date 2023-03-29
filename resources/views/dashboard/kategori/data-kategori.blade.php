@extends('dashboard.layout.main')

@section('container')
<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="mb-2 page-title">Data Tabel Kategori</h2>
        <a class="btn mb-1 btn-success text-white" href="/dashboard/tambah-data-kategori"><i class="fe fe-plus mr-1 fe-16 "></i>Tambah Data</a>
        @if (session()->has('success'))

          <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            {{ session('success') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
           
        @endif
                               
        <div class="row my-4">
          <!-- Small table -->
          <div class="col-md-12">
            <div class="card shadow">
              <div class="card-body">
                <!-- table -->
                <table class="table datatables" id="dataTable-1">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Kategori</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1 ?>
                    @foreach ($kategori as $ar)
                    <tr>
                      <td>{{ $i }}</td>
                      <td>{{ $ar['nama'] }}</td>
                      <td>
                        <div class="row flex align-items-center justify-content-start">
                          <a href="{{ url('/dashboard/data-kategori/edit/'.$ar->id) }}" class="btn mb-2 mr-2 btn-warning text-white">Edit</a>
                          <form action="{{ url('/dashboard/data-kategori/'.$ar['id']) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button class="btn mb-2 btn-danger" onclick="return confirm('yakin hapus data?')">Hapus</button>
                          </form>
                      </div>
                      </td>
                    </tr>
                    
                    <?php $i+=1 ?>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div> <!-- simple table -->
        </div> <!-- end section -->
      </div> <!-- .col-12 -->
    </div> <!-- .row -->
  </div>
@endsection