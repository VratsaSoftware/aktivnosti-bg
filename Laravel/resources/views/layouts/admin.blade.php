<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Aktivnosti-bg') }}</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="{{asset('admin/css/bootstrap.css')}}" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="{{asset('admin/css/font-awesome.css')}}" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="{{asset('admin/css/custom.css')}}" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">{{ config('app.name', 'Aktivnosti-bg') }}</a>
            </div>
            <div style="color: white;padding: 15px 50px 5px 50px;float: right;font-size: 16px;"> {{-- Last access : 30 May 2014 &nbsp; --}}
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary square-btn-adjust">{{ __('Вход') }}</a>   
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                    @endif
                @else
                    <a href="{{ route('logout') }}" class="btn btn-danger square-btn-adjust" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{ __('Изход') }}</a> 
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="{{ (isset(Auth::user()->photo->image_path )) ? asset('/user_files/images/profile/').'/'.Auth::user()->photo->image_path   : asset('/user_files/images/profile/').'/logo.png' }}" class="user-image img-responsive"
                        width="100" height="50">
						<p class="role">{{isset(Auth::user()->role->role) ? Auth::user()->role->role : ''}}</p>
                    </li>
                    <li>
                        <a href="{{route('users.index')}}"><i class="fa fa-users fa-3x"></i> Потребители</a>
                    </li>
                    <li>
                        <a href="{{route('organizations.adminOrg')}}"><i class="fa fa-building-o fa-3x"></i> Организации</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-dribbble fa-3x"></i> Активности<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                        {{--     <li>
                                <a href="#">Групи</a>
                            </li>
                            <li>
                                <a href="#">Разписания</a>
                            </li> --}}
                            <li>
                                <a href="#">Групи<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Разписания</a>
                                    </li>
                                    {{-- <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li> --}}
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="chart.html"><i class="fa fa-table fa-3x"></i> Новини</a>
                    </li>
                    <li>
                        <a href="table.html"><i class="fa fa-bar-chart-o fa-3x"></i> Абонаменти</a>
                    </li>
                    <li>
                        {{-- <a href="form.html"><i class="fa fa-edit fa-3x"></i> Forms </a> --}}
                    </li>
                   
{{--                     <li>
                        <a class="active-menu" href="blank.html"><i class="fa fa-square-o fa-3x"></i> Blank Page</a>
                    </li> --}}
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>@yield('title')</h2>
                        <h5>Здравей {{ isset(Auth::user()->name) ? Auth::user()->name : ''  }}!</h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                @yield('content')
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="{{ asset('admin/js/jquery-1.10.2.js') }}"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="{{ asset('admin/js/jquery.metisMenu.js') }}"></script>
    
    <script src="{{ asset('admin/js/dataTables/jquery.dataTables.js') }}"></script>

    <script src="{{ asset('admin/js/dataTables/dataTables.bootstrap.js') }}"></script>

    <script>
    $(document).ready( function () {
        $('#table_users').dataTable( {
            "columnDefs":
            [{
                "targets": [8],
                "searchable": false,
                "orderable": false,
            }],
            "sPaginationType" : "full_numbers",
        });
    });
    </script>

    <!-- CUSTOM SCRIPTS -->
    <script src="{{ asset('admin/js/custom.js') }}"></script>


</body>

</html>