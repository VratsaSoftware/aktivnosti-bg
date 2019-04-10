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
					@foreach($organization->photos as $photo)
					@endforeach
					<div class="org_image">
						<img src="{{ asset('user_files/images/organization/'.$photo->image_path)}}" alt="{{ $photo->description }}">
					</div>
					
					<h4>{{$organization->name}}</h4>
					<div class="h-10"></div>
				</a>
			</div>
		<!-- end single organization-->
		@endforeach
	</div>
@endsection