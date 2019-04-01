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
                <a class="navbar-brand" href="index.html">{{ config('app.name', 'Aktivnosti-bg') }}</a>
            </div>
            <div style="color: white;padding: 15px 50px 5px 50px;float: right;font-size: 16px;">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-warning square-btn-adjust">{{ __('Вход') }}</a>   
                    @if (Route::has('register'))
                        <a style="color: #ffbf00;" href="{{ route('register') }}">{{ __('Регистрация') }} </a>
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
        @if(Auth::user())
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="{{ isset(Auth::user()->photo->image_path) ? asset('/user_files/images/profile/').'/'.(Auth::user()->photo->image_path) : asset('/user_files/images/profile/').'/logo.png' }}" class="user-image img-responsive">

						<p class="role">{{isset(Auth::user()->role->role) ? Auth::user()->role->role : ''}}</p>
                    </li>

                    <li>
                        <a class="{{ (str_contains(Route::currentRouteName(), 'profile')) ? 'active-menu' : '' }}" href="{{ route('profile.index')}}"><i class="fa fa-user fa-3x"></i> Профил</a>
                    </li>

                    @if (Auth::user()->hasAnyRole(['admin','moderator','organization_manager','organization_member']) && Auth::user()->isApproved())
                        <li>
                            <a class="{{ (Route::currentRouteName() == 'citadel.index') ? 'active-menu' : '' }}" href="{{ route('citadel.index')}}"><i class="fa fa-compass fa-3x"></i> Начало</a>
                        </li>

                        @if (Auth::user()->hasAnyRole(['admin','moderator']))
                            <li>
                                <a class="{{ (str_contains(Route::currentRouteName(), 'user')) ? 'active-menu' : '' }}" href="{{ route('users.index')}}"><i class="fa fa-users fa-3x"></i> Потребители</a>
                            </li>
                        @endif
                    
                        <li>
                            <a class="{{ (str_contains(Route::currentRouteName(), 'organization')) ? 'active-menu' : '' }}" href="{{ route('organizations.adminOrg')}}"><i class="fa fa-building-o fa-3x"></i> Организации</a>
                        </li>
            
                        <li>
                            <a class="{{ (str_contains(Route::currentRouteName(), 'activity')) ? 'active-menu' : '' }}" href="{{ route('activity.index')}}"><i class="fa fa-dribbble fa-3x"></i> Активности</a>
                        </li>
                        <li>
                            <a class="{{ (str_contains(Route::currentRouteName(), 'news')) ? 'active-menu' : '' }}" href="{{ route('news.index')}}"><i class="fa fa-building-o fa-3x"></i> Новини</a>
                        </li>

                        @if (Auth::user()->hasRole('admin'))
                        <li>
                            <a lass="{{ (str_contains(Route::currentRouteName(), 'subscription')) ? 'active-menu' : '' }}" href="{{ route('subscription.index')}}"><i class="fa fa-bar-chart-o fa-3x"></i> Абонаменти</a>
                        </li>
                        @endif
                    @endif
                </ul>
            </div>
        </nav>
        @endif
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>@yield('title')</h2>
                        <h5>Здравей {{ isset(Auth::user()->name) ? Auth::user()->name : ' Гост'  }}!</h5>
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
                "targets": [7],
                "searchable": false,
                "orderable": false,
            }],
            "sPaginationType" : "full_numbers",
        });
        $('#table_organizations').dataTable( {
            "columnDefs":
            [{
                "targets": [6],
                "searchable": false,
                "orderable": false,
            }],
            "sPaginationType" : "full_numbers",
        });
    });


    //show / hide roles check-box
    $(function() {
        $('#moderator_categories').hide();
        var selectedRole = ($( '#role option:selected').text());
        if(selectedRole === 'moderator'){
            $('#moderator_categories').show();
        }
       $( "#role" ).change(function () { 
            selectedRole = ($( '#role option:selected').text());
             if(selectedRole === 'moderator'){
                 $('#moderator_categories').show();
            }
            else{
                $('#moderator_categories').hide();
            }
        });     
    });
    
    </script>

    <!-- CUSTOM SCRIPTS -->
    <script src="{{ asset('admin/js/custom.js') }}"></script>


</body>

</html>