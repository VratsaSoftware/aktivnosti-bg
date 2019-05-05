@extends('layouts.master')

@section('title', $organization->name)

@section('content')
<!-- main-container -->
    <div class="container main-container">
		<!-- left side -->
        <div class="col-md-6 col-sm-6 col-xs-12">

            <!--pictures from Adobe Stock-->
            <div class="org-img">
			@foreach($logo as $photo)
				<img src="{{ asset('user_files/images/organization/'.$photo->image_path)}}" alt="{{ $photo->description }}">			
			@endforeach
            </div>
            <div class="h-30"></div>
        </div>
		<!-- end left side -->
		<!-- right side -->
        <div class="col-md-6 col-sm-6 col-xs-12">
            <h5 class="org"><span>Организация:&nbsp;&nbsp;</span>{{ $organization->name }}</h5>
            <ul class="cat-ul">
                <li><i class="fas fa-calendar-alt"></i>Понеделник до петък от 9:00 до 18:00 ч.</li>
				@if($organization->website)
				<li><i class="fas fa-blog"></i>{{ $organization->website }}</li>
				@endif
                <li><i class="fas fa-envelope"></i>{{ $organization->email }}</li>
                <li><i class="fas fa-mobile-alt"></i>{{ $organization->phone }}</li>
                <li><i class="fas fa-map-marked"></i>{{ $organization->address }}</li>
                <li>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2908.188047764412!2d23.561882!3d43.205545!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xab9ab71f982bf1c5!2z0JjQoiDRhtC10L3RgtGK0YAgLSDQktGA0LDRhtCwINGB0L7RhNGC0YPQtdGA!5e0!3m2!1sen!2sus!4v1551269161962" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                </li>
            </ul>
            <!-- Subscribe button-->
            <div class="popup">
                <div class="popuptext" id="myPopup">
                    <div class="well">
                        <h3>Абонирайте се за още новини от {{ $organization->name }}</h3>
                        <form action="#">
                            <div class="input-contact">
                                <input type="email" name="email">
                                <span>Вашият имейл</span>
                            </div>
                            <div class="button-group">
                                <button href="#" class="btn btn-box">Изпрати</button>
                            </div>
                        </form>
                    </div>
                </div>
                <span class="btn btn-box" onclick="myFunction()"><i class="fas fa-plus"></i>Абонирайте се!</span>
            </div>
            <!-- end Subscribe button-->
        </div>
		<!-- end right side -->
		<div class="col-md-12 col-sm-12">
			<div class="col-md-12 col-sm-12">
			<p class="description-text"><span>За организацията:</span> {{ $organization->description }}</p>
			</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="h-section">
					<img src="{{asset('img/portfolio/fav.png')}}" alt="logo" class="logo-section">
					<h4 class="h-activity"><span>Снимки на {{ $organization->name }}</span></h4>	
				</div>
				<div class="gallery-container">
					<div class="tz-gallery">
						<div class="tz">
							@foreach($gallery as $photo)
							<div class="col-xs-6 col-sm-6 col-md-4">
								<div class="marg">
									<a class="lightbox" href="{{ asset('user_files/images/organization/gallery/'.$photo->image_path)}}">
										<img src="{{ asset('user_files/images/organization/gallery/'.$photo->image_path)}}" alt="image" class="img-responsive" />
									</a>
								</div>
							</div>
							@endforeach						   
						</div>
					</div>
				</div>	
			</div>
			<!-- org activity -->
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="h-section">
					<img src="{{asset('img/portfolio/fav.png')}}" alt="logo" class="logo-section">
					<h4 class="h-activity"><span>Активности на {{ $organization->name }}</span></h4>
				</div>
				<div class="responsive">
					<!-- single work -->
					@foreach($activities as $activity)
					<div>
						<a href="{{route('activities.show', $activity->activity_id)}}" class="portfolio_item">
							@foreach ($activity->photos as $photo)
								@if ($photo->purpose->description == 'mine')
							<img class="activity-img" src="{{ asset('user_files/images/activity/' . $photo->image_path) }}" alt="{{$photo->alt}}" class="img-responsive" />
								@endif
							@endforeach
							<div class="portfolio_item_hover">
								<div class="portfolio-border clearfix">
									<div class="item_info">
										<span>{{$activity->name}}</span>
									</div>
								</div>
								<!-- item logo-->
								<div class="item_logo">
									<img src="{{asset('img/portfolio/'.$activity->category->description)}}" alt="logo">
								</div> 
								<!-- end item logo-->
							</div>
						</a>
					</div>
						@endforeach
					<!-- end single work -->
				</div>
			</div>
		</div>
		<!-- end org activity -->
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