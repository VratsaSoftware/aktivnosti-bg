<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
</head>
<body>
	<!-- Header section -->
	<header class="">
		<div class="">
			<div class="">
				<a href="{{ url('/') }}" class="">
					<img src="img/logo.png" alt="">
				</a>
				@if (Route::has('login'))
                <div class="">
                    @auth
                        <a href="{{ url('home') }}">Profile</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
           		 @endif
		<ul class="">
 			<li>
				<a href="{{ route('users.index') }}">
					Users Management
				</a>
			</li>
			<li>
				<a href="">
					Organizations Management
				</a>
			</li> 
			<li>
				<a href="">
					Activities Management
				</a>
			</li>
		</ul>
		</div>
	</div>
</header>
<section class="">
		<div class="">
			<h3>@yield('pageheader')</h3>
		</div>
</section>
<section class="">
		<div class="">
	@yield('content')
		</div>
</section>
<footer>
</footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
	<script>
		$(document).ready( function () {
    		$('#table_id').dataTable( {
  "columnDefs": [ {
      "targets": [8,9],
      "searchable": false,
      "orderable": false,
    } ]
} );
		});
	</script>
</body>
</html>