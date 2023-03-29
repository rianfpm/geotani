@extends('layout.main')

@section('container')
<!--PAGE TITLE
            =========================================================================================================-->
            <section id="page-title">
                <div class="container ma">
                  <div class="d-block d-sm-flex justify-content-between">
                    <!--Title-->
                    <div class="gtn-title mb-0">
                      <h2>{{ $video->nama }}</h2>
                      <h5 class="gtn-opacity__90">
                        <i class="fa fa-user text-primary"></i>
                        @foreach ($user as $usr)
                            @if ($usr->id == $video->user_id)
                                {{ $usr->nama_depan }} {{ ' ' }} {{ $usr->nama_belakang }} 
                            @endif
                        @endforeach
                      </h5>
                    </div>
                  </div>
                </div>
              </section>
      
              <section id="video" >
                <div class="container mb-5">
                  <div
                    class="embed-responsive embed-responsive-16by9 video gtn-shadow__md"
                  >
                    <iframe
                      src="https://www.youtube.com/embed/{{ $link }}"
                      width="640"
                      height="360"
                      frameborder="0"
                      webkitallowfullscreen
                      mozallowfullscreen
                      allowfullscreen
                    ></iframe>
                  </div>
                </div>
              </section>
      
              <!--CONTENT
                  =========================================================================================================-->
              <section id="content">
                <div class="container">
                  <div class="row flex-wrap-reverse">
                    <!--LEFT SIDE
                              =============================================================================================-->
                    <div class="col-md-5 col-lg-4">
                      <!--DETAILS
                                  =========================================================================================-->
                      <section>
                        <h3>Details</h3>
                        <div class="gtn-box">
                          <dl class="gtn-description-list__line mb-0">
                            <dt>Upload:</dt>
                            <dd>{{ $video->created_at->diffForHumans() }}</dd>
      
                            <dt>Kategori:</dt>
                            
                            @foreach ($kategori as $kat)

                                @if ($kat->id == $video->kategori_id)
                                    <dd>{{ $kat->nama }}</dd>
                                @endif
                                
                            @endforeach
      
                            <dt>Status:</dt>
                            <dd>Publik</dd>
      
                            <dt>Pembuat:</dt>
                            @foreach ($user as $usr)
                                @if ($usr->id == $video->user_id)
                                    <dd>{{ $usr->nama_depan }}</dd>
                                @endif
                            @endforeach
                          </dl>
                        </div>
                      </section>
                      
      
                      <!--ACTIONS
                              =============================================================================================-->
                      <section id="actions" class="mt-3">
                        <div class="d-flex justify-content-between">
                          <a href="#" class="btn-custom mr-2 w-100" data-toggle="tooltip" data-placement="top" title="Add to favorites">
                            <i class="far fa-star"></i> </a>
      
                          <a href="#" class="btn-custom mr-2 w-100" data-toggle="tooltip" data-placement="top" title="Report"  >
                            <i class="fa fa-exclamation-triangle"></i> </a>
      
                          <a href="#" class="btn-custom w-100" data-toggle="tooltip" data-placement="top" title="Share" >
                            <i class="fa fa-share-alt"></i> </a>
                        </div>
                      </section>
                    </div>
                    <!--end col-md-4-->
      
                    <!--RIGHT SIDE
                              =============================================================================================-->
                    <div class="col-md-7 col-lg-8">
                      <!--DESCRIPTION
                                  =========================================================================================-->
                      <section id="description">
                        <h3>Description</h3>
      
                        {!! $video->deskripsi !!}
                      </section>
      
                      <hr class="mb-5" />
      
                      <!--== row starts ==-->
                      <div class="row">
                        <?php $i = 1 ?>
                        @foreach ($all as $al)
                            @if ($al->id == $video->id)
                            @else
                                @if ($i < 4)
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
                                                        <span class="gtn-meta-category"><a href="{{ url('/detail-video/'.$al->id) }}">{{ $kat->nama }}</a></span>
                                                    @endif
                                                
                                                @endforeach
                                                
                                            <h5 class="gtn-post-title">
                                                <a href="{{ url('/detail-video/'.$al->id) }}" rel="bookmark">{{ $al->nama }}</a>
                                            </h5>
                                            </div>
                                        </div>
                                        </div>
                                        <!-- member ends -->
                                    </div>
                                @endif
                            @endif
                        @endforeach
                      </div>
                      <!--== row ends ==-->
                    </div>
      
                    <!--end col-md-8-->
                  </div>
                  <!--end row-->
                </div>
                <!--end container-->
              </section>
@endsection