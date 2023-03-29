@extends('layout.main')

@section('container')

<section class="gtn-section gtn-py-100 my-5">
    <div class="container">
      <!--== row starts ==-->
      <div class="row">
        <!-- column 1 starts -->
        <div class="col-12 col-md-6">
          <img src="assets/images/video-page.png" alt="image" />
        </div>
        <!-- column 1 ends -->

        <!-- column 2 starts -->
        <div class="col-12 col-md-6 small-device-space">
          <!-- heading starts -->
          <div class="gtn-section-intro text-left">
            <div class="gtn-intro-subheading-wrapper">
              <p class="gtn-intro-subheading">Geo Tani</p>
            </div>
            <h2 class="gtn-intro-heading">
              Perbanyak<br />
              Ilmu anda disini<br />
              - Petani cermat
            </h2>
            <p class="gtn-intro-content">
              Saksikan beberapa video tentang pertanian seperti: Menanam,
              merawat, memanen dan lainnya
            </p>
          </div>
          <!-- heading ends -->

          <!-- button -->
          <a
            class="gtn-btn btn-blue gtn-px-lg gtn-mt-50"
            href="#video"
            role="button"
          >
            <span class="gtn-btn-text">Tonton Sekarang</span>
          </a>
        </div>
        <!-- column 2 ends -->
      </div>
      <!--== row ends ==-->
    </div>
  </section>
  <!-- section ends
================================================== -->


  <!-- process section starts
================================================== -->
  <section id="process" class="gtn-section gtn-py-100 bg-white">
    <div class="container">
        <div class="gtn-section-intro text-center gtn-mb-50">
          <div class="gtn-intro-subheading-wrapper">
            <p class="gtn-intro-subheading">Video</p>
          </div>
          <h2 class="gtn-intro-heading">Geotani untuk petani</h2>
          <p class="gtn-intro-content">
            Simak beberapa video yang dapat memberikan pengetahuan
            yang sebelumnya <br />
            belum anda dapatkan
          </p>
        </div>
        <div class="row justify-content-center">
          <div class="gtn-process-bar-center gtn-mb-70 gtn-pt-50 color-dark m-auto">
            <form class="gtn-text-input gtn-mt-20" action="/video">
              <input type="text" name="search" class="gtn-input-text" placeholder="Cari Video yang anda ingin tonton" value="{{ request('search') }}"/>
              <button type="submit" class="gtn-text-btn"></button>
            </form>
          </div>
        </div>

        <div class="row">
          @foreach ($video as $al)
            <div class="col-6 col-md-6 col-lg-4">
              <!-- member starts -->
              <div class="gtn-team gtn-team-social-onhover text-center gtn-team-offset-border gtn-box-rounded">
                <div class="gtn-team-content-wrapper gtn-shadow">
                    <div class="gtn-post-img">
                      <img src="{{ asset('storage/'.$al->foto) }}" alt="image" />
                    </div>
                    <div class="gtn-post-content p-2 pt-4 align-items-center justify-content-center d-flex" style="min-height: 150px">
                        @foreach ($kategori as $kat)

                            @if ($kat->id == $al->kategori_id)
                                <span class="gtn-meta-category"><a href="#">{{ $kat->nama }}</a></span>
                            @endif
                        
                        @endforeach
                        
                        <h5 class="gtn-post-title">
                            <a href="{{ url('/detail-video/'.$al->id) }}" rel="bookmark">{{ $al->nama }}</a>
                        </h5>
                    </div>
                </div>
              </div>
            </div>
          @endforeach
  
        </div>

    </div>
  </section>

@endsection