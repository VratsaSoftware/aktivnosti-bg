@extends('layouts.master')

@section('title', 'Новини')

@section('content')
		<!-- main-container -->
	@php($i=1)	
	<div class=" container main-container">
		<div class="col-md-12 col-sm-12">
			@foreach($news as $one_news)
			<!-- single news-->
			<div class="col-md-4 col-sm-6 service-box">
				<!-- service-box -->
				@foreach($one_news->photos as $photo)
				<img src="{{ asset('user_files/images/news/'.$photo->image_path)}}" alt="{{ $photo->description }}">
				@endforeach
				<h3>{{$one_news->heading}}</h3>
				<p>{{ $one_news->article_type::find($one_news->article_id)->name }} / <span> {{Carbon\Carbon::parse($one_news->date)->format('j.m.Y')}}</span></p>
				
				@php($i++)
				<!-- end service-box -->
				<!-- Trigger the modal with a button -->
				<button type="button" class="btn btn-box" data-toggle="modal" data-whatever="@mdo" data-target="#myModal{{$i}}">Прочети</button>

				<div class="modal fade myModal" id="myModal{{$i}}" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
						<!-- Modal -->
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h3>{{$one_news->heading}}</h3>
							</div>
							<div class="modal-body">
								<div class="col-md-6 col-sm-6">
									@foreach($one_news->photos as $photo)
									<img src="{{ asset('user_files/images/news/'.$photo->image_path)}}" alt="{{ $photo->description }}">
									@endforeach
								</div>
								<div class="col-md-6 col-sm-6">
									<p>{{str_limit($one_news->description, 250)}} </p><a href="{{route('news.show', $one_news->news_id)}}"> цялата новина</a>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-box" data-dismiss="modal">Затвори</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end single news-->
			@endforeach
		</div>		
		
	</div> 
   {{$news->links()}}
    <!-- end main-container -->

@endsection
<script>
$('.myModal').modal();
</script>