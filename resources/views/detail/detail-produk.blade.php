@extends('layout.main')

@section('container')
<!--PAGE TITLE
            =========================================================================================================-->
                <section id="page-title">
                    <div class="container ma">
                        <div class="d-block d-sm-flex justify-content-between">
                            <!--Title-->
                            <div class="gtn-title mb-0">
                                <h2>{{ $produk->nama }}</h2>
                                <h5>Rp {{ $produk->harga }}</h5>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="content">
                    <div class="container">
                        <div class="row">
                            <!--LEFT SIDE
                                    =============================================================================================-->
                            <div class="col-md-5 col-lg-4">
                            <!--DETAILS
                                        =========================================================================================-->
                            <section>
                                <h3>Foto</h3>
                                <div
                                id="carouselExampleIndicators"
                                class="carousel slide"
                                data-ride="carousel"
                                >
                                <ol class="carousel-indicators">
                                    <li
                                    data-target="#carouselExampleIndicators"
                                    data-slide-to="0"
                                    class="active"
                                    ></li>
                                    <li
                                    data-target="#carouselExampleIndicators"
                                    data-slide-to="1"
                                    ></li>
                                    <li
                                    data-target="#carouselExampleIndicators"
                                    data-slide-to="2"
                                    ></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active gtn-team-img">
                                    <!-- <img src="..." class="d-block w-100" alt="..."> -->
                                    <img src="{{ asset('storage/'.$produk->foto) }}" alt="image" />
                                    </div>
                                    <div class="carousel-item gtn-team-img">
                                    <img src="{{ asset('storage/'.$produk->foto) }}" alt="image" />
                                    </div>
                                    <div class="carousel-item gtn-team-img">
                                    <img src="{{ asset('storage/'.$produk->foto) }}" alt="image" />
                                    </div>
                                </div>
                                <button
                                    class="carousel-control-prev"
                                    type="button"
                                    data-target="#carouselExampleIndicators"
                                    data-slide="prev"
                                >
                                    <span
                                    class="carousel-control-prev-icon"
                                    aria-hidden="true"
                                    ></span>
                                    <span class="sr-only">Previous</span>
                                </button>
                                <button
                                    class="carousel-control-next"
                                    type="button"
                                    data-target="#carouselExampleIndicators"
                                    data-slide="next"
                                >
                                    <span
                                    class="carousel-control-next-icon"
                                    aria-hidden="true"
                                    ></span>
                                    <span class="sr-only">Next</span>
                                </button>
                                </div>
                                <!-- <div class="gtn-team-img"> <img src="../assets/images/prd1.jpg" alt="image"> -->
                            </section>
                            
                            <br>
                            <!--ACTIONS
                                    =============================================================================================-->
                            <section id="actions">
                                <div class="d-flex justify-content-between">
                                <a
                                    href="#"
                                    class="btn-custom mr-2 w-100"
                                    style="margin-right: 5px"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Add to favorites"
                                >
                                    <i class="far fa-star"></i>
                                </a>
            
                                <a
                                    href="#"
                                    class="btn-custom mr-2 w-100"
                                    style="margin-right: 5px"
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
                                    <h3>Description</h3>
                
                                    {!! $produk->deskripsi !!}
                
                                    <dl
                                    class="gtn-description-list__line mb-0 gtn-column-count-2"
                                    style="margin-top: 50px"
                                    >
                                        <dt>Stok:</dt>
                                        <dd class="border-bottom pb-2">{{ $produk->stok }}</dd>
                    
                                        <dt>Kategori:</dt>
                                        @foreach ($kategori as $kat)
                                            @if ($kat->id == $produk->kategori_id)
                                                <dd class="border-bottom pb-2">{{ $kat->nama }}</dd>
                                            @endif
                                        @endforeach
                    
                                        <dt>Berat:</dt>
                                        <dd class="border-bottom pb-2">{{ $produk->berat }}</dd>

                                        <dt>Status:</dt>
                                        <dd class="border-bottom pb-2">Sale</dd>
                                    </dl>
                                    <div class="justify-content-start d-flex">
                                    <a href="#">
                                        <div class="btn-custom col-3 col-lg-2 mt-4">
                                        <a href="#" class="gtn-whatsapp" title="whatsapp"></a>
                                        <p>Pesan</p>
                                        </div>
                                    </a>
                                    </div>
                                </section>

                                <br>
            
                                <div class="row">
                                    <hr class="mb-5" />
                
                                    <h3>Mungkin yang anda cari</h3>
                                    <?php $i = 1 ?>
                                    @foreach ($all as $al)
                                        @if ($al->id == $produk->id)
                                        @else
                                            @if ($i < 4)
                                                <div class="col-6 col-md-6 col-lg-3">
                                                    <div class="gtn-team gtn-team-social-onhover text-center gtn-team-offset-border gtn-box-rounded">
                                                        <div class="gtn-team-content-wrapper gtn-shadow">
                                                            <div class="gtn-team-img">
                                                                <img src="{{ asset('storage/'.$al->foto) }}" alt="image" />
                                                            </div>
                                                            <div class="gtn-team-content bg-white">
                                                                <h5 class="gtn-team-title">{{ $al->nama }}</h5>
                                                                <p class="gtn-team-subtitle mb-2">{{ $al->harga }}</p>
                                                                <!-- team social starts -->
                                                                <div class="gtn-team-social mt-5">
                                                                <ul class="gtn-social gtn-social-list">
                                                                    <li>
                                                                    <div class="btn-shop">
                                                                        <a href="{{ url('/detail-produk/'.$al->id) }}"><p>Beli</p></a>
                                                                    </div>
                                                                    </li>
                                                                </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                
                                    @endforeach
                
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </section>
@endsection