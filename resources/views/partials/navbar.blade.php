
      <!-- Small Devices Header
============================================= -->
<div class="gtn-responsive-header header-with-slick-menu fixed-top">
    <div class="container">
      <!-- small devices logo -->
      <div class="gtn-responsive-header-left">
        <a class="gtn-logo" href="/"><img src="{{ asset('assets/images/logo.png') }}" alt="logo" /></a>
      </div>

      <!-- small devices logo ends -->

      <!-- menu button -->
      <button id="gtn-menu-button" class="gtn-hamburger" type="button">
        <span class="gtn-hamburger-lines-wrapper"><span class="gtn-hamburger-lines"></span></span>
      </button>
    </div>
    <div class="gtn-responsive-header-menu"></div>
  </div>
  <!-- Small Devices Header ends
============================================= -->

  <!-- header starts
============================================= -->
  <header id="gtn-header-global" class="fixed-top">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between">
        <!-- header left starts -->
        <div class="gtn-header-left">
          <!-- logo -->
          <a class="logo-default gtn-scroll-link" href="#home"><img src="{{ asset('assets/images/logo.png') }}" alt="logo" /></a>

          <!-- logo on scroll -->
          <a class="logo-alt gtn-scroll-link" href="#home"><img src="{{ asset('assets/images/logo.png') }}" alt="logo" /></a>
          <!-- logo on scroll ends -->
        </div>
        <!-- header left ends -->

        <!-- menu starts-->
        <div class="main-navigation">
          <ul class="sf-menu gtn-nav dark-nav-on-load dark-nav-on-scroll">
           <li><a class="nav-link" href="/">Beranda</a></li>
            <li><a class="nav-link" href="/belanja">Belanja</a></li>
            <li><a class="nav-link" href="/video">Video</a></li>
            <li><a class="nav-link" href="/artikel">Artikel</a></li>
            <li><a class="nav-link" href="/tentang-kami">Tentang Kami</a></li>


            @auth
              @if (auth()->user()->roles==1)
                <li><a class="nav-link" href="/dashboard">Dashboard</a></li>
                <li><a class="nav-link" href=""><form action="/logout" method="POST" >@csrf<button type="submit" style="border-radius: 40px; padding:  5% 15%; margin-right: 40px; background-color: '#05182b'; border-width:0px">Logout</button></form></a></li>
              @else
                <li><a class="nav-link" href=""><form action="/logout" method="POST" >@csrf<button type="submit" style="border-radius: 40px; padding:  5% 15%; margin-right: 40px; background-color: '#05182b'; border-width:0px">Logout</button></form></a></li>
              @endif
            @else
            <li><a class="nav-link" href="/login"> Login</a></li>
            @endauth
            
          </ul>
        </div>
        <!-- menu ends -->
      </div>
    </div>
  </header>
  <!-- header ends
================================================== -->
