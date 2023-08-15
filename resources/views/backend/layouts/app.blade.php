<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Blog @yield('title') </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/brand/favicon.ico') }}" />

    <!-- TITLE -->
    <title>Sash – Bootstrap 5 Admin & Dashboard Template</title>


    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- STYLE CSS -->

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/dark-style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/transparent-style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/transparent-style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/skin-modes.css') }}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/colors/color1.css') }}" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{ asset('backend/images/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            @include('backend.layouts.partials.header')
            @include('backend.layouts.partials.sidebar')

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        @yield('breadcrumb')
                        <!-- PAGE-HEADER END -->

                        @yield('content')

                    </div>
                    <!-- CONTAINER END -->
                </div>
            </div>
            <!--app-content close-->

        </div>

        <!-- FOOTER -->
        @include('backend.layouts.partials.footer')
        <!-- FOOTER END -->

    </div>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

      <!-- JQUERY JS -->
      @vite(['resources/js/app.js'])
      <script src="{{ asset('assets/js/jquery.min.js')}}"></script>

      <!-- BOOTSTRAP JS -->
      <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
      <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

      <!--SIDEMENU JS -->
      <script src="{{ asset('assets/plugins/sidemenu/sidemenu.js')}}"></script>

      <!-- TypeHead js -->
      <script src="{{ asset('assets/plugins/bootstrap5-typehead/autocomplete.js')}}"></script>
      <script src="{{ asset('assets/js/typehead.js')}}"></script>

      <!-- COUNTERS JS-->
      <script src="{{ asset('assets/plugins/counters/counterup.min.js')}}"></script>
      <script src="{{ asset('assets/plugins/counters/waypoints.min.js')}}"></script>
      <script src="{{ asset('assets/plugins/counters/counters-1.js')}}"></script>

      <!-- SIDEBAR JS -->
      <script src="{{ asset('assets/plugins/sidebar/sidebar.js')}}"></script>

      <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

      <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>

      <!-- Perfect SCROLLBAR JS-->
      <script src="{{ asset('assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>
      <script src="{{ asset('assets/plugins/p-scroll/pscroll.js')}}"></script>
      <script src="{{ asset('assets/plugins/p-scroll/pscroll-1.js')}}"></script>

      <script src="{{ asset('assets/plugins/summernote/summernote1.js')}}"></script>
      <script src="{{ asset('assets/js/summernote.js')}}"></script>



      <!-- Color Theme js -->
      <script src="{{ asset('assets/js/themeColors.js')}}"></script>

      <!-- Sticky js -->
      <script src="{{ asset('assets/js/sticky.js')}}"></script>

      <!-- CUSTOM JS -->
      <script src="{{ asset('assets/js/custom.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script src="{{asset('assets/js/common.js')}}"></script>


    @stack('scripts')
</body>

</html>
