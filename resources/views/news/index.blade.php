@extends('layouts.master')

@section('pagelinks')
  <!-- baguetteBox gallery -->
  <link rel="stylesheet" href="{{asset('css/baguetteBox.min.css')}}">
    <!-- slick slider -->
  <link rel="stylesheet" type="text/css" href="{{asset('slick/slick.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('slick/slick-theme.css')}}"/>

  <script src="{{asset('js/baguetteBox.min.js') }}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.js"></script>
@endsection

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
									<p class="description-text">{{str_limit($one_news->description, 250)}} </p><a href="{{route('news.show', $one_news->news_id)}}"> цялата новина</a>
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
		{{$news->links()}}

		<div class="row text-center">
        	<a href="{{ url()->previous() }}" class="btn btn-box"><i class="fas fa-chevron-left"></i>&nbsp;Обратно</a>

        	@if(url()->previous() !== url('/')."/")
            	<a href="{{ url('/')}}" class="btn btn-box"><i class="fas fa-home"></i>&nbsp;Начална</a>
        	@endif
    	</div>
	</div>

    <!-- end main-container -->

@endsection
<script>
$('.myModal').modal();
</script>
@section('og')
@php($organization = App\Models\Organization::select()->where('name', 'Aktivnosti.bg')->whereNotNull('approved_at')->first())
@if(isset($organization->name))
<meta property="og:title" content="{{$organization->name}}"/>
<meta property="og:image" content="{{ asset('/img/portfolio/logo2.jpg')}}"/>
<meta property="og:type" content="{{$organization->description}}" />
@endif
@endsection

@section('pagescript')
    <!-- single page script-->
	<script src="{{asset('js/modernizr.js')}}"></script>
    <script type="text/javascript" src="{{asset('slick/slick.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('slick/slick-starter.js')}}"></script>
	<script src="{{asset('js/schedule.js')}}"></script>
	<script src="{{asset('js/baguetteBox.min.js') }}"></script>
	<script src="{{asset('js/limititems.js')}}"></script>
	<script src="{{ asset('js/share.js') }}"></script>
	<script src="{{ asset('js/slick.js') }}"></script>
    <!-- lightBox start-->
	<script>
		baguetteBox.run('.tz-gallery', {
		  captions: true, // display image captions.
		  buttons: 'auto', // arrows navigation
		  fullScreen: false,
		  noScrollbars: true,
		  bodyClass: 'baguetteBox-open',
		  titleTag: false,
		  async: false,
		  preload: 2,
		  animation: 'slideIn', // fadeIn or slideIn
		  verlayBackgroundColor: 'rgba(0,0,0,.8)'
		});
	</script>
@endsection
