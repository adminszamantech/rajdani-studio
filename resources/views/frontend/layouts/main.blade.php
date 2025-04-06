
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metas -->
    <meta charset="utf-8">
    <meta name="author" content="Chitrakoot Web" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="Building Construction Template" />
    <meta name="description" content="Structure - Building Construction Template" />
    <!-- title  -->
    <title>@yield('title', 'Railway Construction Company')</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('/storage/admin/assets/images/logo/'.website()->favicon_image) }}" />
    <link rel="apple-touch-icon" href="{{ asset('/storage/admin/assets/images/logo/'.website()->favicon_image) }}" />
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/storage/admin/assets/images/logo/'.website()->favicon_image) }}" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/storage/admin/assets/images/logo/'.website()->favicon_image) }}" />

    <link rel="stylesheet" href="{{ asset('/storage/frontend/css/plugins.css') }}" />
    <link rel="stylesheet" href="{{ asset('/storage/frontend/css/rev_slider/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/frontend/css/rev_slider/layers.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/frontend/css/rev_slider/navigation.css') }}">
    <link rel="stylesheet" href="{{ asset('/storage/frontend/search/search.css') }}" />
    <link href="{{ asset('/storage/frontend/css/styles.css') }}" rel="stylesheet" />
</head>

<body>
    <div id="preloader">
        <div class="row loader">
            <div class="loader-icon"></div>
        </div>
    </div>


    <div class="main-wrapper">
        @include('frontend.layouts.header')

        <main class="">
            @yield('content')
        </main>

        @include('frontend.layouts.footer')
    </div>


    <a href="javascript:void(0)" class="scroll-to-top"><i class="fas fa-angle-up" aria-hidden="true"></i></a>
    <script src="{{ asset('/storage/frontend/js/core.min.js') }}"></script>
    <script src="{{ asset('/storage/frontend/search/search.js') }}"></script>
    <script src="{{ asset('/storage/frontend/js/rev_slider/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('/storage/frontend/js/rev_slider/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('/storage/frontend/js/rev_slider/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('/storage/frontend/js/rev_slider/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script src="{{ asset('/storage/frontend/js/rev_slider/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('/storage/frontend/js/rev_slider/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('/storage/frontend/js/rev_slider/extensions/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('/storage/frontend/js/rev_slider/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('/storage/frontend/js/rev_slider/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ asset('/storage/frontend/js/rev_slider/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('/storage/frontend/js/rev_slider/extensions/revolution.extension.video.min.js') }}"></script>
    <script src="{{ asset('/storage/frontend/js/main.js') }}"></script>

</body>
</html>
