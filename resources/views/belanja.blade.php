
@extends('layout.main')

@section('container')
<section id="home" class="gtn-section">
          <div class="gtn-section bg-white gtn-hero-section-top-padding">
            <div class="container gtn-pb-100">
              <!--== row starts ==-->
              <div class="row">
                <div class="col-12 col-md-6">
                  <!-- animated hedline starts -->
                  <p
                    class="gtn-animated-headline font-weight-medium text-left slide color-dark"
                  >
                    <span class="gtn-words-wrapper w-100">
                      <!--== text starts ==-->
                      <!-- first line -->
                      <b class="is-visible"
                        >Segar
                        <img
                          draggable="false"
                          role="img"
                          class="emoji"
                          alt="✨"
                          src="https://s.w.org/images/core/emoji/13.1.0/svg/2728.svg"
                          width="22"
                      /></b>
                      <!-- second line -->
                      <b class="is-hidden">
                        Berkualitas
                        <img
                          draggable="false"
                          role="img"
                          class="emoji"
                          alt="⚡"
                          src="https://s.w.org/images/core/emoji/13.1.0/svg/26a1.svg"
                          width="22"
                        />
                      </b>
                      <!-- third line -->
                      <b class="is-hidden">
                        Murah
                        <img
                          draggable="false"
                          role="img"
                          class="emoji"
                          alt="⭐"
                          src="https://s.w.org/images/core/emoji/13.1.0/svg/2b50.svg"
                          width="22"
                        />
                      </b>
                      <!--== text ends ==-->
                    </span>
                  </p>
                  <!-- animated hedline ends -->

                  <h1 style="font-size: 60px;">Sayur dan Benih <br />
                      Berkualitas
                  </h1>
                  <p class="gtn-intro-content color-dark">
                    Beli sayur dan benih tanaman segar dan berkualitas disini.
                  </p>

                  <!-- button starts -->
                  <a
                    class="gtn-btn btn-blue gtn-px-lg gtn-mt-50"
                    href="#"
                    role="button"
                  >
                    <span class="gtn-btn-text">Belanja Sekarang</span>
                  </a>
                  <!-- button ends -->
                </div>
                <div class="col-12 col-md-6 small-device-space">
                  <img src="assets/images/seed1.jpg" alt="image" />
                </div>
              </div>
              <!--== row ends ==-->
            </div>
          </div>
        </section>
        <!-- hero section ends
================================================== -->

        <!-- process section ends
================================================== -->

        <!-- team section starts
================================================== -->
        <section id="team" class="gtn-section gtn-pt-100 gtn-pb-70">
          <div class="container">
            <!-- heading starts -->
            <div class="gtn-section-intro text-center gtn-mb-50">
              <div class="gtn-intro-subheading-wrapper">
                <p class="gtn-intro-subheading">Geo Tani</p>
              </div>
              <h2 class="gtn-intro-heading">Produk-produk terbaik GeoTani</h2>
              <p class="gtn-intro-content">Cari kebutuhan pertanianmu disini</p>
            </div>
            <!-- heading ends -->

            <div class="gtn-process-bar-center gtn-mb-70 gtn-pt-50 color-dark m-auto">
              <div><a href="#" class="gtn-twitter" target="_blank" title="twitter"></a></div>
              <form class="gtn-text-input gtn-mt-20" action="/belanja">
                <input type="text" name="search" class="gtn-input-text" placeholder="Cari Produk yang anda inginkan" value="{{ request('search') }}"/>
                <button type="submit" class="gtn-text-btn"></button>
              </form>
            </div>

            <div class="row">

              @foreach ($produk as $pr)
                
                <div class="col-6 col-md-6 col-lg-3">
                  <!-- member starts -->
                  <div class="gtn-team gtn-team-social-onhover text-center gtn-team-offset-border gtn-box-rounded">
                    <div class="gtn-team-content-wrapper gtn-shadow">
                      <div class="gtn-team-img">
                        <img src="{{ asset('storage/'.$pr->foto) }}" alt="image" />
                      </div>
                      <div class="gtn-team-content bg-white">
                        <h5 class="gtn-team-title">{{ $pr->nama }}</h5>
                        <p class="gtn-team-subtitle mb-2">{{ $pr->harga }}</p>
                        <!-- team social starts -->
                        <div class="gtn-team-social mt-5">
                          <ul class="gtn-social gtn-social-list">
                            <li>
                              <div class="btn-shop">
                                <a href="{{ url('/detail-produk/'.$pr->id) }}"><p>Beli</p></a>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- member ends -->
                </div>
              @endforeach

            </div>
          </div>
        </section>
        @endsection