<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel </title>
    @yield('ajax')
    <link href='https://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/source/assets/dest/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/source/assets/dest/vendors/colorbox/example3/colorbox.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/source/assets/dest/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/source/assets/dest/rs-plugin/css/responsive.css">
    <link rel="stylesheet" title="style" href="{{ env('APP_URL') }}/source/assets/dest/css/style.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/source/assets/dest/css/animate.css">
    <link rel="stylesheet" title="style" href="{{ env('APP_URL') }}/source/assets/dest/css/huong-style.css">
    <link href="{{ env('APP_URL') }}/source/assets/vnpay/bootstrap.min.css" rel="stylesheet" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZM5D8YTXNN"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-ZM5D8YTXNN');
    </script>
    <!-- Custom styles for this template -->
    <link href="{{ env('APP_URL') }}/source/assets/vnpay/jumbotron-narrow.css" rel="stylesheet">
    <script src="{{ env('APP_URL') }}/source/assets/vnpay/jquery-1.11.3.min.js"></script>
</head>

<body>

    @include('Partial.header')
    @yield('content')
    @include('Partial.footer')

    <!-- include js files -->
    <script src="{{ env('APP_URL') }}/source/assets/dest/js/jquery.js"></script>
    <script src="{{ env('APP_URL') }}/source/assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="{{ env('APP_URL') }}/source/assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
    <script src="{{ env('APP_URL') }}/source/assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
    <script src="{{ env('APP_URL') }}/source/assets/dest/vendors/animo/Animo.js"></script>
    <script src="{{ env('APP_URL') }}/source/assets/dest/vendors/dug/dug.js"></script>
    <script src="{{ env('APP_URL') }}/source/assets/dest/js/scripts.min.js"></script>
    <script src="{{ env('APP_URL') }}/source/assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script src="{{ env('APP_URL') }}/source/assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src="{{ env('APP_URL') }}/source/assets/dest/js/waypoints.min.js"></script>
    <script src="{{ env('APP_URL') }}/source/assets/dest/js/wow.min.js"></script>
    <!--customjs-->
    <script src="source/assets/dest/js/custom2.js"></script>
    <script>
        $(document).ready(function($) {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 150) {
                    $(".header-bottom").addClass('fixNav')
                } else {
                    $(".header-bottom").removeClass('fixNav')
                }
            })
        })
    </script>
    @yield ('footer_scripts')
</body>

</html>
