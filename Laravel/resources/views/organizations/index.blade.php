@extends('layouts.master')

@section('title', 'организации')

@section('content')
		<!-- main-container -->	
	<div class=" container main-container">
			@foreach($organizations as $organization)
			<!-- single organization-->
				<div class="col-md-3 col-sm-6 service-box">
					<a href="{{ route('organizations.show',$organization->organization_id)}}">
						<!-- service-box -->
						<div class="org_image">
						@if(!empty($organization->photos->all()))
						@foreach($organization->photos as $photo)
							@if($photo->purpose->description == 'logo'&& $photo->purpose->description != 'gallery' &&$photo->image_path!='logo.png')													
							<img src="{{ asset('user_files/images/organization/'.$photo->image_path)}}" alt="{{ $photo->description }}">
							
							@endif
						@endforeach
						@else
							<img src="{{ asset('/img/portfolio/logo2.jpg')}}" alt="logo">							
						@endif						
						</div>
						<h4>{{$organization->name}}</h4>
						<div class="h-10"></div>
					</a>
				</div>
			<!-- end single organization-->
			@endforeach
		{{$organizations->links()}}
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