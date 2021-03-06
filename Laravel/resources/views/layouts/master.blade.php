<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Aktivnosti.bg</title>
    <link rel="icon" href="{{asset('img/fav.png')}}" type="image/x-icon">
    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Ionic icons-->
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <!-- main css -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- range slider -->
    <link href="{{asset('css/rangeslider.css')}}" rel="stylesheet">
    <!-- modernizr -->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>
    <script src="{{asset('js/modernizr.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="pre-container">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
    <!-- end Preloader -->
@include('includes.header')

    @if(Request::is('/'))
        @include('includes.topbar')
    @else
        @include('includes.singletopbar')
    @endif

@yield('content')

@include('includes.footer')
    <!-- back to top -->
    <a href="#0" class="cd-top"><i class="ion-android-arrow-up"></i></a>
    <!-- end back to top -->
    <!-- jQuery -->
    <script src="{{asset('js/jquery-2.1.1.js')}}"></script>
    <!-- <script src="js/jquery-3.3.1.min.js"></script>
            <script src="js/jquery-migrate-3.0.0.min.js"></script> -->
    <!--  plugins -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/menu.js')}}"></script>
    <script src="{{asset('js/animated-headline.js')}}"></script>
    <script src="{{asset('js/isotope.pkgd.min.js')}}"></script>
    <!--  custom script -->
    <script src="{{asset('js/custom.js')}}"></script>
    <!-- Change top-bar h1 and background script!!!  -->
    <script src="{{asset('js/intro.js')}}"></script>
    <!-- Range Slider script -->
    <script src="{{asset('js/rangeslider.min.js')}}"></script>
    <script src="{{asset('js/rangeslider.js')}}"></script>
    <!-- google analytics  -->
    <!-- <script src="js/google_analytics.js"></script> -->
    <!-- single page script-->
    <script src="{{asset('js/slider.js')}}"></script>
    <script src="{{asset('js/slick.js')}}"></script>
	<script src="{{asset('js/schedule.js')}}"></script>
	<script src="{{asset('js/limititems.js')}}"></script>
</body>

</html>