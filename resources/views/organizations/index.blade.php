@extends('layouts.master')

@section('title', 'организации')

@section('content')
		<!-- main-container -->
	<div class=" container main-container">
			@foreach($organizations as $organization)
				@php
					$logo = 0
				@endphp
			<!-- single organization-->
				<div class="col-md-3 col-sm-6 service-box">
					<a href="{{ route('organizations.show',$organization->organization_id)}}">
						<!-- service-box -->
						<div class="org_image">

						@foreach($organization->photos->sortByDesc('updated_at') as $photo)
							@if($photo->purpose->description == 'logo' && $photo->purpose->description != 'gallery')
							<img src="{{ asset('user_files/images/organization/'.$photo->image_path)}}" alt="{{ $photo->description }}">
								@php
									$logo = 1
								@endphp
								@break
							@endif
						@endforeach

						@if($logo == 0)
							<img src="{{ asset('/img/portfolio/logo2.jpg')}}" alt="logo">
						@endif

						</div>
					</a>
					<a href="{{ route('organizations.show',$organization->organization_id)}}">
						<h4>{{$organization->name}}</h4>
						<div class="h-10"></div>
					</a>
				</div>
			<!-- end single organization-->
			@endforeach
			<div class="col-md-12 col-sm-6 service-box">
				{{$organizations->links()}}
			</div>
	</div>

@endsection
@section('og')
@php($organization = App\Models\Organization::select()->where('name', 'Aktivnosti.bg')->whereNotNull('approved_at')->first())
@isset($organization)
	<meta property="og:title" content="{{$organization->name}}"/>
	<meta property="og:image" content="{{ asset('/img/portfolio/logo2.jpg')}}"/>
	<meta property="og:type" content="{{$organization->description}}" />
@endisset
@endsection
