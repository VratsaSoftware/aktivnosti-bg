<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-51734359-9"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){
			dataLayer.push(arguments);
			}
		gtag('js', new Date());
		gtag('config', 'UA-51734359-9');
	</script>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>

	@yield('css')

    @yield('pagelinks')

    <!--Terms banner-->
    <link rel="stylesheet" type="text/css" href="//wpcc.io/lib/1.0.2/cookieconsent.min.css"/>

    @stack('head')
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
	<script src="{{asset('js/baguetteBox.min.js') }}"></script>
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


    <!-- Cookie Banner -->
    <script src="//wpcc.io/lib/1.0.2/cookieconsent.min.js"></script>
    <script>window.addEventListener("load", function(){window.wpcc.init({"corners":"normal","colors":{"popup":{"background":"#ffbf00","text":"#494949","border":"#fde296"},"button":{"background":"#ffffff","text":"#000000"}},"position":"bottom","border":"thin","fontsize":"large","content":{"href":"{{route('static.terms')}}","message":"Aktivnosti.bg използва бисквитки. Научете повече в нашата Политика относно бисквитките.","link":"Моля прочетете нашите \"Условия за ползване\".","button":"Съгласен съм!"}})});
    </script>


	<script src="{{asset('/js/filterAjax.js')}}"></script>
    <script src="https://use.fontawesome.com/2c7a93b259.js"></script>

    @yield('pagescript')

</body>

</html>
