@extends('layouts.master')

@section('title', $activity->name)

@section('content')
		
		<!-- main-container -->
	<div class="container main-container">
		<div class="col-md-6 col-sm-6 col-xs-12">
		   <!--pictures from Adobe Stock-->
			@foreach ($logo as $photo)
			<div class="act-img">
				<img src="{{ asset('user_files/images/activity/' . $photo->image_path) }}" alt="{{$photo->alt}}" class="img-responsive" />
			</div>						
			@endforeach
			<div class="h-30"></div>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<h3 class="text-uppercase">{{$activity->name}}</h3>
			{{-- <h5 class="org"><span>Водещ:&nbsp;&nbsp;</span>{{$activity->organization->name}}</h5> --}}
			<a href="{{ route('organizations.show', $activity->organization->organization_id) }}"><h5 class="org"><span>Организация:&nbsp;&nbsp;</span>{{$activity->organization->name}}</h5></a>
			<ul class="cat-ul">
			@if($activity->fixed_start == 1)
			
				<li><i class="fas fa-calendar-alt"></i>Дата на започване: {{Carbon\Carbon::parse($activity->start_date)->format('j . m . Y')}}</li>
				@if(isset($activity->end_date))
				<li><i class="fas fa-calendar-alt"></i>Дата на приключване: {{Carbon\Carbon::parse($activity->end_date)->format('j . m . Y')}}</li>
				@endif
				@if(isset($activity->duration))
				<li><li><i class="fas fa-clock"></i>Продължителност: {{$activity->duration}}</li>
				@endif
			@endif
				@foreach ($activity->groups as $group)
				<li><i class="fas fa-calendar-alt"></i><a href="schedule.html" target="_blank">{{$group->name}}
					<ul> 
						@foreach ($group->schedules as $schedule)
						<li>{{$schedule->day}} от {{$schedule->start_time}} до {{$schedule->end_time}}</li>
						@endforeach
					</ul>
				</a></li>
				@endforeach
				@if(isset($activity->requirements))
				<li><i class="fas fa-tasks"></i>Носете си: <span class="task">{{$activity->requirements}}</span></li>
				@endif
				<li><i class="fas fa-envelope"></i>{{$activity->organization->email}}</li>
				<li><i class="fas fa-mobile-alt"></i>{{$activity->organization->phone}}</li>
				<li><i class="fas fa-map-marked"></i>{{$activity->address}}</li>
				<li><iframe  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2908.237680849323!2d23.561281315213787!3d43.204503889346924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40ab1918e0ad3683%3A0x8f5b83eedef3b7ed!2z0KHQn9Ce0KDQotCd0J4g0KPQp9CY0JvQmNCp0JUg0JrQm9CY0JzQldCd0KIg0J7QpdCg0JjQlNCh0JrQmA!5e0!3m2!1sbg!2sbg!4v1549027551316" width="100%" height="130" frameborder="0" style="border:0" allowfullscreen></iframe></li>
			</ul>
			<!-- Subscribe button-->
			<div class="popup" >
				<div class="popuptext" id="myPopup">
					<div class="well">
						<h3>Абонирайте се за още новини от Fly yoga</h3>
						<form action="#">
							<div class="input-contact">
								<input type="text" name="email">
								<span>Вашият имейл</span>
							</div>
							<div class="button-group">
								<button class="btn btn-box">Изпрати</button>
							</div>
						</form>
					</div>
				</div>
				<span class="btn btn-box" onclick="myFunction()"><i class="fas fa-plus"></i>Абонирайте се!</span>
			</div>
			<!-- end Subscribe button-->
			<!--social list-->
			<h4 class="social-h4">Сподели</h4>
			<ul class="social-ul">
				<li class="box-social"><a href="#0"><i class="fab fa-facebook-f"></i></a></li>
				<li class="box-social"><a href="#0"><i class="fab fa-instagram"></i></a></li>
				<li class="box-social"><a href="#0"><i class="fab fa-google-plus-g"></i></a></li>
				<li class="box-social"><a href="#0"><i class="fab fa-twitter"></i></a></li>
			</ul>

		</div>
		
		<div class="col-md-12">
			<p class="description-text"><span>За нас:</span> {{$activity->description}}</p>
		</div>
		<!--right side-->
		<div class="col-md-6 col-sm-12">
				<h4 class="h-activity"><span>Снимки на {{ $activity->name }}</span></h4>	
				<div class="gallery-container">
					<div class="tz-gallery">
						<div class="row">
							@foreach($gallery as $photo)
							<div class="col-xs-6 col-sm-6 col-md-4">
								<div class="marg">
									<a class="lightbox" href="{{ asset('user_files/images/activity/'.$photo->image_path)}}">
										<img src="{{ asset('user_files/images/activity/'.$photo->image_path)}}" alt="image" class="img-responsive" />
									</a>
								</div>
							</div>
							@endforeach						   
						</div>
					</div>
				</div>	
			</div>
		<div class="col-md-6 col-sm-12">
			<h4 class="h-activity"><span>Подобни активности</span></h4>
			<!-- slick-slider-->
			<div class="slider_item">
				<section class="regular slider">
					<!--single item-->
					@php($activitySubcategory = $activity->subcategory_id)
					@php($activityActivityId = $activity->activity_id)
					
					@foreach($activities as $activ)
						@if(($activ->subcategory_id == $activitySubcategory) && ($activ->activity_id !== $activityActivityId) && (!empty($activ->approved_at)) && ($activ->available == 1))
						<a href="{{ route('activities.show', $activ->activity_id)}}" class="portfolio_item">
							@foreach ($activ->photos as $photo)
								@if ($photo->purpose->description == 'mine')
							<img src="{{ asset('user_files/images/activity/' . $photo->image_path) }}" alt="{{$photo->alt}}" class="img-responsive" />
								@endif
							@endforeach
							<div class="portfolio_item_hover">
								<div class="portfolio-border clearfix">
									<div class="item_info">
										<span class="description">{{$activ->name}}</span>
										<em class="name">{{$activ->organization->name}}</em>
									</div>
								</div>
							</div>
						</a>
						@endif
					@endforeach
				<!--end single item-->
				</section>
			</div>
		
			<!-- end slick-slider-->	
			{{--<h5><span>Предложения от категория {{$activity->category->name}}</span></h5>
			<!-- slick-slider-->
			<div class="slider_item">
				<section class="regular slider">
					{{$category = $activity->category_id}}
					@foreach($activities as $activ)
						@if(($activ->category_id == $category) && ($activ->activity_id !== $activityActivityId) && ($activ->subcategory_id !== $activitySubcategory) && (!empty($activ->approved_at)) && ($activ->available == 1))
							<a href="{{ route('activities.show', $activ->activity_id)}}" class="portfolio_item">
							@foreach ($activ->photos as $photo)
								@if ($photo->purpose->description == 'mine')
								<img src="{{ asset('user_files/images/activity/' . $photo->image_path) }}" alt="{{$photo->alt}}" class="img-responsive" />
								@endif
							@endforeach
							<div class="portfolio_item_hover">
								<div class="portfolio-border clearfix">
									<div class="item_info">
										<span class="description">{{$activ->name}}</span>
										<em class="name">{{$activ->organization->name}}</em>
									</div>
								</div>
							</div>
							</a>
						@endif
					@endforeach		
				</section>
			</div>--}}
			<!-- end slick-slider-->	
		</div>
		<!--end right side-->		
	</div>
	<!-- end main-container -->

@endsection