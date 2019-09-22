@extends('layouts.master')

@section('title', 'организации')

@section('content')
	<div class=" container main-container">
		@foreach($organizations as $organization)
			@php
				$logo = 0
			@endphp
			<div class="col-md-3 col-sm-6 no-padding">
				<a href="{{ route('organizations.show', $organization->organization_id)}}" class="gallery-box portfolio_item">
					<span class="gallery-box__img-container">
						@foreach($organization->photos->sortByDesc('updated_at') as $photo)
							@if($photo->purpose->description == 'logo' && $photo->purpose->description != 'gallery')
							<img src="{{ asset('user_files/images/organization/'.$photo->image_path)}}" alt="{{ $photo->description }}" class="gallery-box__img">
								@php
									$logo = 1
								@endphp
								@break
							@endif
						@endforeach
						@if($logo == 0)
							<img src="{{ asset('/img/portfolio/logo2.jpg')}}" alt="logo" class="gallery-box__img">
						@endif
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
			<div class="col-md-12 col-sm-12 text-center">
        		<a href="{{ URL::to('/') }}" class="btn btn-box"><i class="fas fa-chevron-left"></i>&nbsp;Начало</a>
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
