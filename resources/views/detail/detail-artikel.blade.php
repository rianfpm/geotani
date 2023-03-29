@extends('layout.main')

@section('container')
    <section id="page-title">
        <div class="container ma">
        <div class="d-block d-sm-flex justify-content-between">
            <!--Title-->
            <div class="gtn-title mb-0">
            <h2>{{ $artikel->nama }}</h2>
            <h5 class="gtn-opacity__90">
                <i class="fa fa-user text-primary"></i>
                {{ $artikel->user->nama_depan.' '.$artikel->user->nama_belakang }}
            </h5>
            </div>
        </div>
        </div>
    </section>

    <section id="foto">
        <div class="container mb-3 foto">
        <img class="foto" src="{{ asset('storage/'.$artikel->foto) }}" alt="" />
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
                    <dd>{{ $artikel->created_at->diffForHumans() }}</dd>

                    <dt>Kategori:</dt>
                    {{ $artikel->kategori->nama }}

                    <dt>Status:</dt>
                    <dd>Publik</dd>

                    <dt>Pembuat:</dt>
                    {{ $artikel->user->nama_depan }}
                </dl>
                </div>
            </section>

            <!--ACTIONS
                    =============================================================================================-->
            <section id="actions">
                <div class="d-flex justify-content-between">
                <a
                    href="#"
                    class="btn-custom mr-2 w-100"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Add to favorites"
                >
                    <i class="far fa-star"></i>
                </a>

                <a
                    href="#"
                    class="btn-custom mr-2 w-100"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Report"
                >
                    <i class="fa fa-exclamation-triangle"></i>
                </a>

                <a
                    href="#"
                    class="btn-custom w-100"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Share"
                >
                    <i class="fa fa-share-alt"></i>
                </a>
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
                    {!! $artikel->deskripsi !!}
                    <br />
                </section>

                <div class="row">
                    <hr class="mb-5" />

                    <h3>Mungkin yang anda cari</h3>
                    <br />

                    <!-- column 3 starts -->
                    
                    <?php $i = 1 ?>
                        @foreach ($all as $al)
                            @if ($al->id == $artikel->id)
                            @else
                                @if ($i < 4)
                                    <div class="col-6 col-md-4 col-sm-6 mb-5"">
                                        <div class="gtn-post-item">
                                            <div class="gtn-post-img">
                                                <img src="{{ asset('storage/'.$al->foto) }}" alt="image" />
                                            </div>
                                            <div class="gtn-post-content">
                                                <span class="gtn-meta-category">
                                                    <a href="#">{{ $al->kategori->nama }}</a>
                                                </span>
                                                <h5 class="gtn-post-title mb-0">
                                                    <a href="#" rel="bookmark">{{ $al->nama }}</a>
                                                </h5>
                                                <div class="hide mt-0">
                                                    <a class="gtn-read-more mt-2" href="{{ url('/detail-artikel/'.$al->id) }}">
                                                        <span class="gtn-read-more-content">Selengkapnya ...</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach


                </div>
                <!-- column 3 ends -->
            </div>
        <!--end row-->
        </div>
        <!--end container-->
    </section>
@endsection