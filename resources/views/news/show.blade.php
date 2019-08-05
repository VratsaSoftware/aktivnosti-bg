
@extends('layouts.master')

@section('title', $news->heading)

@section('content')
<!-- main-container -->
    <div class="container main-container">
		<!-- left side -->
        <div class="col-md-5 col-sm-6 col-xs-12">

            <!--pictures from Adobe Stock-->
            <div class="news_img">
			@foreach($news->photos as $photo)
				<img src="{{ asset('user_files/images/news/'.$photo->image_path)}}" alt="{{ $photo->description }}">			
			@endforeach
            </div>
			<!--social list-->
			{!! Share::currentPage()
				->facebook(['class' => 'my-class', 'id' => 'my-id'])
				->twitter()
				->googlePlus()
				->linkedin(); !!}
			<!--end social list-->
        </div>
		<!-- end left side -->
		<!-- right side -->
        <div class="col-md-7 col-sm-6 col-xs-12">
            <h2 class="org">{{$news->heading}}</h2>
			@if($news->article_type::first()->getTable()!='categories')
			<a href="{{ route(''.$news->article_type::first()->getTable().'.show', $news->article_id) }}">@endif<h5 class="org">{{ $news->article_type::find($news->article_id)->name }}</h5>@if($news->article_type::first()->getTable()!='categoories')</a>@endif
            <ul class="cat-ul">
                <li><i class="fas fa-calendar-alt"></i>{{Carbon\Carbon::parse($news->date)->format('j.m.Y')}}</li>
            </ul>
			<p class="description-text">{{$news->description}}</p>
        </div>
		<!-- end right side -->
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="h-section">
				<img src="{{asset('img/portfolio/fav.png')}}" alt="logo" class="logo-section">
				<h4 class="h-activity"><span>Снимки</span></h4>	
			</div>
			<div class="gallery-container">
				<div class="tz-gallery">
					<div class="tz">
						@foreach($news->photos as $photo)
						<div class="col-xs-6 col-sm-6 col-md-3">
							<div class="marg">
								<a class="lightbox news_img" href="{{ asset('user_files/images/news/'.$photo->image_path)}}">
									<img src="{{ asset('user_files/images/news/'.$photo->image_path)}}" alt="image" class="img-responsive" />
								</a>
							</div>
						</div>
						@endforeach						   
					</div>
				</div>
			</div>	
		</div>
    </div>
	<script>
	$(function() {
  $(".img-w").each(function() {
    $(this).wrap("<div class='img-c'></div>")
    let imgSrc = $(this).find("img").attr("src");
     $(this).css('background-image', 'url(' + imgSrc + ')');
  })
            
  
  $(".img-c").click(function() {
    let w = $(this).outerWidth()
    let h = $(this).outerHeight()
    let x = $(this).offset().left
    let y = $(this).offset().top
    
    
    $(".active").not($(this)).remove()
    let copy = $(this).clone();
    copy.insertAfter($(this)).height(h).width(w).delay(500).addClass("active")
    $(".active").css('top', y - 8);
    $(".active").css('left', x - 8);
    
      setTimeout(function() {
    copy.addClass("positioned")
  }, 0)
    
  }) 
  
})

$(document).on("click", ".img-c.active", function() {
  let copy = $(this)
  copy.removeClass("positioned active").addClass("postactive")
  setTimeout(function() {
    copy.remove();
  }, 500)
})
	</script>
    <!-- end main-container -->
@endsection
@section('og')
<meta property="og:title" content="{{ $news->heading }}" />
<meta property="og:image" content="@foreach($news->photos as $photo){{ asset('user_files/images/news/'.$photo->image_path)}}@break @endforeach"/>
<meta property="og:type" content="{{$news->description}}" />
@endsection							