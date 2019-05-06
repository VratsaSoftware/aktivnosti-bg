
@extends('layouts.master')

@section('title', 'Новини')

@section('content')
	<!-- main-container -->		
	<div class=" container main-container">
		<!-- itemslimits -->
		<div class="container col-md-12"> 
			<!-- single news-->
			<div class="col-md-4 col-sm-6 service-box">
				<!-- service-box -->
				@foreach($news->photos as $photo)
				<img src="{{ asset('user_files/images/news/'.$photo->image_path)}}" alt="{{ $photo->description }}">
				@endforeach
				<h3>{{$news->heading}}</h3>
				<div class="h-10"></div>
				<!-- end service-box -->
				<!-- Trigger the modal with a button -->
				<button type="button" class="btn btn-box" data-toggle="modal" data-target="#myModal">Прочети</button>
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
						<!-- Modal -->
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h3>{{$news->heading}}</h3>
							</div>
							<div class="modal-body">
								<div class="col-md-6 col-sm-6">
									@foreach($news->photos as $photo)
									<img src="{{ asset('user_files/images/news/'.$photo->image_path)}}" alt="{{ $photo->description }}">
									@endforeach
								</div>
								<div class="col-md-6 col-sm-6">
									<p>{{$news->description}} </p>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-box" data-dismiss="modal">Затвори</button>
							</div>
						</div>
					</div>
					{{$news->article_type}}
				</div>
			</div>
			<!-- end single news-->
		</div> 
	</div>
    <!-- end main-container -->

@endsection
						