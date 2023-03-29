<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="ThemeStarz" />
    <link href="{{ asset('dashboard-assets/assets/images/logo-pav.png') }}" rel="shortcut icon" />
    <!--CSS -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/fontawesome-all.min.css') }}" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.scrollbar.css') }}" />
    <!-- CSS FILES -->
    <link rel="stylesheet" href="{{ asset('assets/css/leaflet.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/iconfont.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/color.css') }}" />

    <title>Geotani - {{ $title }}</title>
  </head>
  <body>
    <div id="gtn-wrapper" class="clearfix">

    <?php if(isset($preload)):?>
      @include('partials.preload')
    <?php endif; ?>

        @include('partials.navbar')
    
        <!-- == main content area starts == -->
        <div id="gtn-main-content">
      
            @yield('container')

            @include('partials.footer')

        </div>
        <!-- == main content area ends == -->

        
        <!-- take top arrow -->
        <a id="take-to-top" href="#" class="gtn-fade-scroll"></a>
    </div>
    <!-- #gtn-wrapper ends -->
    
    <script src="https://kit.fontawesome.com/7016843f62.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/sly.min.js') }}"></script>
    <script src="{{ asset('assets/js/dragscroll.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/leaflet.js') }}"></script>
    <script src="{{ asset('assets/js/leaflet.markercluster.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/custom2.js') }}"></script>
    <script src="{{ asset('assets/js/map-leaflet.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script>
    function searchmap() {
      let latitude  = $("#latitude ").val();
      let longitude = $("#longitude").val();

      centerLatitude = latitude;
      centerLongitude = longitude;
      map.setView([centerLatitude, centerLongitude], mapDefaultZoom);
      loadData();
    }
      </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
