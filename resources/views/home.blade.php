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
                  >Rekomendasi Tanaman
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
                  Video Edukasi
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
                  Artikel Pertanian
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

            <h1>Digitalisasi Pertanian</h1>
            <p class="gtn-intro-content color-dark">
              Pangan adalah jantung dari sebuah kehidupan. Maka dari itu,
              pertanian menjadi sangat penting saat ini. Geotani hadir
              untuk mendigitalisasi pertanian yang ada di Indonesia! Mari
              Coba semua fitur dari Geotani disini
            </p>

            <!-- button starts -->
            <a
              class="gtn-btn gtn-btn-small gtn-mt-50"
              href="#gtn-hero"
              role="button"
            >
              <!-- icon -->
              <i class="fa-solid fa-seedling" aria-hidden="true"></i>
              <p>
                <!-- subtext -->
                <span class="gtn-btn-subtext ml-5">Mulai</span>
                <!-- text -->
                <span class="gtn-btn-text ml-3">Cari Lokasi</span>
              </p>
            </a>
            <!-- button ends -->
          </div>
          <div class="col-12 col-md-6 small-device-space hide">
            <img src="assets/images/plt1.jpg" alt="image" />
          </div>
        </div>
        <!--== row ends ==-->
      </div>
    </div>
  </section>

  <section class="gtn-section gtn-py-100 my-5 about">
    <div class="container">
      <!--== row starts ==-->
      <div class="row">
        <!-- column 1 starts -->
        <div class="col-12 col-md-6">
          <img
            src="assets/images/favicon.png"
            alt="image"
            height="500px"
          />
        </div>
        <!-- column 1 ends -->

        <!-- column 2 starts -->
        <div
          class="col-12 col-md-6 small-device-space align-items-center d-flex"
        >
          <!-- heading starts -->
          <div class="gtn-section-intro text-left">
            <div class="gtn-intro-subheading-wrapper">
              <p class="gtn-intro-subheading">Apa itu GeoTani?</p>
            </div>
            <h2 class="gtn-intro-heading">GeoTani</h2>
            <p class="gtn-intro-content">
              GeoTani solusi hebat untuk petani cermat. Geotani merupakan
              website yang menyediakan berbagai layanan seperti
              rekomendasi tanaman, artikel, dan juga video edukasi.
            </p>
            <!-- button -->
            <!-- <a class="gtn-btn btn-blue gtn-px-lg gtn-mt-50" href="#" role="button"> <span class="gtn-btn-text">Tonton
            Sekarang</span> </a> -->
          </div>
          <!-- heading ends -->
        </div>
        <!-- column 2 ends -->
      </div>
      <!--== row ends ==-->
    </div>
  </section>

  <!-- hero section ends
================================================== -->
  <section>
    <!-- heading starts -->
    <div class="gtn-section-intro text-center gtn-mb-50 mt-5">
      <div class="gtn-intro-subheading-wrapper">
        <p class="gtn-intro-subheading">Geotani</p>
      </div>
      <h2 class="gtn-intro-heading">Rekomendasi Tanaman</h2>
      <h3 class="gtn-intro-heading">Untukmu</h3>
      <p class="gtn-intro-content">
        Cari lokasimu & lihat tanaman apa yang bisa ditanam didaerahmu
      </p>
    </div>
    <!-- heading ends -->
  </section>

  <!-- HERO MAP
=================================================================================================================-->
<section id="gtn-hero" class="mb-5">
    <!--Fullscreen mode-->
    <div class="gtn-full-screen gtn-has-horizontal-results w-1001 d-flex1 flex-column1">
      <!-- MAP
      =========================================================================================================-->
      <div class="gtn-map gtn-shadow__sm">
        <!-- FORM
          =====================================================================================================-->
        <div class="gtn-form__map-search gtn-z-index__2">
          <!--Form-->
          <form class="gtn-form">
            <!--Collapse button-->
            <a href=".gtn-form-collapse" data-toggle="collapse" class="gtn-center__vertical justify-content-between">
              <h5 class="mb-0 ml-5">Search Filter</h5>
            </a>

            <!--Form-->
            <div class="gtn-form-collapse gtn-xs-hide-collapse collapse show">
              <!--Keyword-->
              <div class="form-group my-2 pt-2">
                <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Masukkan Latitude" />
              </div>
              
              <div class="form-group my-2 pt-2">
                <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Masukan Longitude " />
              </div>

              <!--Submit button-->
              <div class="form-group mt-4 mb-3">
                <button type="submit" class="btn w-100" id="search-btn">Cari Lokasi</button>
              </div>

              <!--end more-options-collapse-->
            </div>
            <!--end gtn-form-collapse-->
          </form>
          <!--end gtn-form-->
        </div>
        <!--end gtn-form__map-search-->

        <div
          id="gtn-map-hero"
          class="h-100 gtn-z-index__1"
          data-gtn-map-leaflet-provider="https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png"
          data-gtn-map-leaflet-attribution="&copy; <a href='http://www.openstreetmap.org/copyright'>OpenStreetMap</a> &copy; <a href='http://cartodb.com/attributions'>CartoDB</a>"
          data-gtn-map-zoom-position="bottomright"
          data-gtn-map-scroll-wheel="1"
          data-gtn-map-zoom="13"
          data-gtn-map-center-latitude="-6.597676329350807"
          data-gtn-map-center-longitude="106.79945570749875"
          data-gtn-locale="en-US"
          data-gtn-currency="USD"
          data-gtn-unit="m<sup>2</sup>"
          data-gtn-display-additional-info="area_Area;bedrooms_Bedrooms;bathrooms_Bathrooms"
        ></div>
      </div>

      <!-- RESULTS
      =========================================================================================================-->
      <div id="gtn-results" class="gtn-results__horizontal scrollbar-inner dragscroll">
        <div class="gtn-section-intro text-center"></div>
        <div class="gtn-resulgtn-wrapper"></div>
      </div>
    </div>
    <!--end full-screen-->
  </section>
  <!--end gtn-hero-->

  <section class="gtn-section gtn-pt-100 gtn-pb-70 bg-white" id="video">
    <div class="container">
      <!-- heading starts -->
      <div class="gtn-section-intro text-left gtn-mb-50">
        <div class="gtn-intro-subheading-wrapper">
          <p class="gtn-intro-subheading">Yuk Belanja</p>
        </div>
        <h2 class="gtn-intro-heading">Kebutuhan Pertanian</h2>
        <p class="gtn-intro-content">
          Harga terbaik untuk dirimu yang hebat
        </p>
      </div>
      <!-- heading ends -->

      <!--== row starts ==-->
      <div class="row">
        <?php $i = 1 ?>
          @foreach ($produk as $pr)
            @if ($i < 4)
              <div class="col-6 col-md-6 col-lg-3">
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
              </div>
            @endif
        @endforeach
      </div>
      <!--== row ends ==-->
    </div>
  </section>

  <section class="gtn-section gtn-pt-100 gtn-pb-70 bg-white" id="video">
    <div class="container">
      <!-- heading starts -->
      <div class="gtn-section-intro text-left gtn-mb-50">
        <div class="gtn-intro-subheading-wrapper">
          <p class="gtn-intro-subheading">Video untukmu</p>
        </div>
        <h2 class="gtn-intro-heading">Berbagai video menarik</h2>
        <p class="gtn-intro-content">video rekomendasi hanya untukmu</p>
      </div>
      <!-- heading ends -->

      <!--== row starts ==-->
      <div class="row">
        <?php $i = 1 ?>
        @foreach ($video as $vi)
          @if ($i < 4)
              <div class="col-6 col-md-6 col-lg-4">
                  <!-- member starts -->
                  <div class="gtn-team gtn-team-social-onhover text-center gtn-team-offset-border gtn-box-rounded">
                  <div class="gtn-team-content-wrapper gtn-shadow">
                      <div class="gtn-post-img">
                      <img src="{{ asset('storage/'.$vi->foto) }}" alt="image" />
                      </div>
                      <div class="gtn-post-content p-2 pt-4 align-items-center justify-content-center d-flex" style="min-height: 150px">
                        <span class="gtn-meta-category"><a href="{{ url('/detail-video/'.$vi->id) }}">{{ $vi->kategori->nama }}</a></span>
                      <h5 class="gtn-post-title">
                          <a href="{{ url('/detail-video/'.$vi->id) }}" rel="bookmark">{{ $vi->nama }}</a>
                      </h5>
                      </div>
                  </div>
                  </div>
                  <!-- member ends -->
              </div>
          @endif
        @endforeach
      </div>
      <!--== row ends ==-->
    </div>
  </section>

  <section class="gtn-section gtn-pt-100 gtn-pb-70 bg-white" id="video">
    <div class="container">
      <!-- heading starts -->
      <div class="gtn-section-intro text-left gtn-mb-50">
        <div class="gtn-intro-subheading-wrapper">
          <p class="gtn-intro-subheading">Artikel Terbaik</p>
        </div>
        <h2 class="gtn-intro-heading">Artikel Pertanian</h2>
        <p class="gtn-intro-content">Spesial hanya untukmu</p>
      </div>
      <!-- heading ends -->

      <!--== row starts ==-->
      <div class="row">
        <?php $i = 1 ?>
        @foreach ($artikel as $ar)
          @if ($i < 4)
              <div class="col-6 col-md-4 col-sm-6 mb-5"">
                  <div class="gtn-post-item">
                    <div class="gtn-post-img">
                        <img src="{{ asset('storage/'.$ar->foto) }}" alt="image" />
                    </div>
                  <div class="gtn-post-content">
                      <span class="gtn-meta-category">
                        <a href="#">{{ $ar->kategori->nama }}</a>
                      </span>
                      <h5 class="gtn-post-title">
                          <a href="#" rel="bookmark">{{ $ar->nama }}</a>
                      </h5>
                      <div class="hide">
                          <a class="gtn-read-more mt-0" href="{{ url('/detail-artikel/'.$ar->id) }}">
                              <span class="gtn-read-more-content">Selengkapnya ...</span>
                          </a>
                      </div>
                  </div>
                </div>
              </div>
          @endif
        @endforeach
      </div>
      <!--== row ends ==-->
    </div>
  </section>

@endsection