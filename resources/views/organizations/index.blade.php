@extends('layouts.master')

@section('title', 'организации')

@section('content')
		<!-- main-container -->
	<div class=" container main-container">
			@foreach($organizations as $organization)		
		<div class="col-md-3 col-sm-6 no-padding">
			<a href="{{ route('organizations.show', $organization->organization_id)}}" class="gallery-box portfolio_item">
				<span class="gallery-box__img-container">
					@foreach($organization->photos->sortByDesc('updated_at') as $photo)
						@if($photo->purpose->description == 'logo' && $photo->purpose->description != 'gallery' && $photo->image_path!='logo.png')
					<img src="{{ asset('user_files/images/organization/'.$photo->image_path)}}" class="gallery-box__img" alt="{{ $photo->description }}">
						@break
					@else
					<img src="{{ asset('/img/portfolio/logo2.jpg')}}" alt="logo" class="gallery-box__img">
						@break
					@endif
					@endforeach
				
				</span>
				<span class="gallery-box__text-wrapper">
					<span class="gallery-box__text">
						{{$organization->name}}
					</span>
				</span>
			</a>
			</div>
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
