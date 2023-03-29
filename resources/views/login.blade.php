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
              <h2 class="gtn-intro-heading">ACCOUNT LOGIN</h2>
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

                    
                    @if (session()->has('success'))

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ session('success') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                      
                    @endif
                    @if (session()->has('loginError'))

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ session('loginError') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                      
                    @endif

                    <form action="/login" method="POST">
                      @csrf
                      <p class="gtn-form-row">
                        <label>Email</label>
                        @error('email')
                          <p class="gtn-error" style="color: red; font-size:small">{{ $message }}</p>
                        @enderror
                        <input
                          name="email"
                          type="text"
                          placeholder="Email"
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
                      <p class="gtn-form-column">
                        <input
                          type="radio"
                          name="remember_me"
                          value="remember_me"
                        />Remember Me
                      </p>
                      <div class="gtn-form-row">
                        <p class="gtn-form-row">Belum punya akun? <a href="/signup">Register</a></p>
                      </div>
                      <p
                      class="text-end"
                      style="margin-top: -40px; margin-right: 20px"
                    >
                      <button class="gtn-btn" type="submit">LOGIN</button>
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