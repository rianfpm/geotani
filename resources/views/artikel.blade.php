@extends('layout.main')

@section('container')

<section id="blog" class="gtn-section gtn-py-100 bg-white">
    <div class="container">
      <div class="gtn-section-intro text-center gtn-mb-50">
        <div class="gtn-intro-subheading-wrapper">
          <p class="gtn-intro-subheading">Berita &amp; Artikel</p>
        </div>
        <h2 class="gtn-intro-heading">Artikel Terkini dan Terbaru</h2>
        <p class="gtn-intro-content">
          Baca dan lihat berbagai artikel tentang pertanian<br />
          Anda akan mendapatkan banyak insight baru
        </p>

        <div class="gtn-process-bar-center gtn-mb-70 gtn-pt-50 color-dark m-auto">
          <div><a href="#" class="gtn-twitter" target="_blank" title="twitter"></a></div>
          <form class="gtn-text-input gtn-mt-20" action="/artikel">
            <input type="text" name="search" class="gtn-input-text" placeholder="Cari artikel yang ingin anda tahu" value="{{ request('search') }}"/>
            <button type="submit" class="gtn-text-btn"></button>
          </form>
        </div>
      </div>

      <!--== row starts ==-->
      <div class="row">
        @foreach ($artikel as $ar)
          <!-- column 3 starts -->
          <div class="col-6 col-md-4 col-sm-6 mb-5"">
            <div class="gtn-post-item">
              <div class="gtn-post-img"><img src="{{ asset('storage/'.$ar->foto) }}" alt="image" /></div>
              <div class="gtn-post-content">
              <span class="gtn-meta-category">{{ $ar->kategori->nama }}</span>

                <h5 class="gtn-post-title mb-0"><a href="{{ url('/detail-artikel/'.$ar->id) }}" rel="bookmark">{{ $ar->nama }}</a></h5>
                <div class="hide mt-0">
                    {{-- <p class="gtn-post-excerpt">Budidaya tanaman pangan merupakan suatu kegiatan menanam tanaman yang menjadi sumber karbohidrat utama....</p> --}}
                    <a class="gtn-read-more mt-2" href="{{ url('/detail-artikel/'.$ar->id) }}"><span class="gtn-read-more-content">Selengkapnya ...</span></a>
                </div>
              </div>
            </div>
          </div>
          <!-- column 3 ends -->
        @endforeach

      </div>
      <!--== row ends ==-->
    </div>
  </section>

@endsection