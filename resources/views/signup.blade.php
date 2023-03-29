@extends('layout.main')

@section('container')
<img class="geo-bg" src="assets/images/logo-g-01.png" alt="" />
<!-- contact section starts
================================================== -->
<section id="contact" class="gtn-section gtn-py-100">
  <div class="container">
    <!-- heading starts -->

    <div class="gtn-section-intro text-center gtn-mb-50">
      <div class="gtn-intro-subheading-wrapper">
        <p class="gtn-intro-subheading">GEOTANI</p>
      </div>
      <h2 class="gtn-intro-heading">ACCOUNT REGISTRATION</h2>
      <p class="gtn-intro-content">
        Solusi Hebat Untuk Petani Cermat
        <img
          draggable="false"
          role="img"
          class="emoji"
          alt="✨"
          src="https://s.w.org/images/core/emoji/13.1.0/svg/2728.svg"
          width="20px"
        />
      </p>
    </div>
    <!-- heading ends -->

    <!--== row starts ==-->
    <div class="row">
      <!-- column 1 starts -->
      <div class="col-12 col-md-10 offset-md-1">
        <div class="gtn-box-wrapper">
          <div class="gtn-box gtn-shadow">
            <!-- form starts -->
            <form action="/signup" method="POST">
              @csrf
              <p class="gtn-form-row">
                <label>Nama Depan</label>
                @error('nama_depan')
                  <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                @enderror
                <input
                  name="nama_depan"
                  id="nama_depan"
                  type="text"
                  placeholder="Nama Depan"
                  value="{{ old('nama_depan') }}"
                />
                
              </p>
              <p class="gtn-form-row">
                <label>Nama Belakang</label>
                @error('nama_belakang')
                  <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                @enderror
                <input
                  name="nama_belakang"
                  type="text"
                  placeholder="Nama Belakang"
                  value="{{ old('nama_belakang') }}"
                />
              </p>
              <p class="gtn-form-row">
                <label>Email</label>
                @error('email')
                  <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                @enderror
                <input
                  name="email"
                  class="required email"
                  type="text"
                  placeholder="Email"
                  value="{{ old('email') }}"
                />
              </p>
              <p class="gtn-form-row">
                <label>Pekerjaan</label>
                @error('pekerjaan')
                  <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                @enderror
                <input
                  name="pekerjaan"
                  type="text"
                  placeholder="Pekerjaan"
                  value="{{ old('pekerjaan') }}"
                />
              </p>
              <p class="gtn-form-row">
                <label>Nomor Handphone</label>
                @error('no_hp')
                  <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                @enderror
                <input
                  name="no_hp"
                  type="text"
                  placeholder="Nomor Handphone"
                  value="{{ old('no_hp') }}"
                />
              </p>
              <p class="gtn-form-row">
                <label>Password</label>
                @error('password')
                  <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                @enderror
                <input
                  name="password"
                  type="password"
                  placeholder="Password"
                />
              </p>

              <div class="gtn-form-row">
                <p class="gtn-form-row">Sudah punya akun? <a href="/login">Login</a></p>
              </div>
              <p
                class="text-end"
                style="margin-top: -40px; margin-right: 20px"
              >
                <button class="gtn-btn" type="submit">
                  REGISTRASI
                </button>
              </p>
            </form>
          </div>
        </div>
      </div>
      <!-- column 1 ends -->
    </div>
    <!--== row ends ==-->
  </div>
</section>
<!-- contact section ends
================================================== -->
@endsection