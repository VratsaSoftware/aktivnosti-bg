
@extends('layouts.master')

@section('title', $activity->name)

@section('content')

@push('head')
	<!-- Maps support -->
	<script>
		//prepare variables for js
		var latitude = '{{  $activity->latitude }}',
			longitude = '{{  $activity->longitude }}',
			auth = '{{ env("MAP_KEY",'') }}',
			activity_id = '{{  $activity->activity_id }}',
			city = '{{ $activity->city->name }}',
			address = '{{ str_replace(str_split('\\/:*?"<>|$!@'),'',$activity->address) }}';
	</script>
	<script src="{{ asset('js/map.js') }}"></script>
	<script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap' async defer></script>
@endpush

	<!-- main-container -->
	<div class="container main-container">
		<div class="col-md-6 col-sm-6 col-xs-12">
		   <!--pictures from Adobe Stock-->
			@foreach ($logo as $photo)
			<div class="act-img">
				<img src="{{ asset('user_files/images/activity/' . $photo->image_path) }}" alt="{{$photo->alt}}" class="img-responsive" />
			</div>
				@break
			@endforeach
			<div class="h-30"></div>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<h3 class="text-uppercase">{{$activity->name}}</h3>
			@isset($activity->organization->name)
			{{-- <h5 class="org"><span>Водещ:&nbsp;&nbsp;</span>{{$activity->organization->name}}</h5> --}}
			<a href="{{ route('organizations.show', $activity->organization->organization_id) }}"><h5 class="org"><span>Организация:&nbsp;&nbsp;</span>{{$activity->organization->name}}</h5></a>
			@endisset
			<ul class="cat-ul">
			{{-- Start date will be shown when activity has fixed start--}}
			@if($activity->fixed_start == 1)
				<li><i class="fas fa-calendar-alt"></i>Дата на започване: {{Carbon\Carbon::parse($activity->start_date)->format('j . m . Y')}}</li>
				@if(isset($activity->duration))
				<li><li><i class="fas fa-clock"></i>Продължителност: {{$activity->duration}}</li>
				@endif
			@endif
			{{-- End date will be shown if available--}}
			@if(isset($activity->end_date))
				<li><i class="fas fa-calendar-alt"></i>Дата на приключване: {{Carbon\Carbon::parse($activity->end_date)->format('j . m . Y')}}</li>
			@endif
				@if(isset($activity->requirements))
				<li><i class="fas fa-tasks"></i>Носете си: <span class="task">{{$activity->requirements}}</span></li>
				@endif
				@isset($activity->organization->name)
				<li><i class="fas fa-envelope"></i>{{$activity->organization->email}}</li>
				<li><i class="fas fa-mobile-alt"></i>{{$activity->organization->phone}}</li>
				@endisset
				<li><i class="fas fa-map-marked"></i>{{$activity->address}}</li>
				<li>
					 <div id="myMap" style="position:relative;width:100%;height:130px;"></div>
				</li>
			</ul>
			<!-- Subscribe button-->
			<div class="popup" >
				<div class="popuptext" id="myPopup">
					<div class="well">
						<h3>Абонирайте се за още новини от {{$activity->name}}</h3>
						<form action="#">
							<div class="input-contact">
								<input type="email" name="email">
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
			{!! Share::currentPage()
				->facebook(['class' => 'my-class', 'id' => 'my-id'])
				->twitter(); !!}
			<!--end social list-->

		</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
	@if(count($activity->groups)!=0)
		<div class="col-md-6 col-sm-12">
			<p class="description-text"><span>За нас:</span> {{$activity->description}}</p>
		</div>
		<div class="col-md-6 col-sm-12 col-xs-12">
		       <!-- Advanced Tables -->
			<div class="event-info">
                <p><i class="fas fa-info"></i>График на сформираните групи</p>
            </div>

			<div class="table-responsive">
				@if(session()->has('message'))
				<div class="alert alert-success">
					 {{ session()->get('message') }}
				</div>
				@endif
				<table class="table table-striped table-bordered table-hover" id="table_users">
					<thead>
						<tr>
							<th>Група</th>
							<th>Описание</th>
							<th>Ден от седмицата</th>
							<th>Началo</th>
							<th>Край</th>
						</tr>
					</thead>
					<tbody>
						@foreach($activity->groups as $group)
						<tr>
							<td><p>{{ $group->name }}</p></td>
							<td><p>{{ $group->description }}</p></td>
							<td>@foreach($group->schedules as $schedule)<p>{{ $schedule->day }}</p>@endforeach</td>
							<td>@foreach($group->schedules as $schedule)<p>{{Carbon\Carbon::parse($schedule->start_time)->format('H:i')  }}</p>@endforeach</td>
							<td>@foreach($group->schedules as $schedule)<p>{{Carbon\Carbon::parse($schedule->end_time)->format('H:i')  }}</p>@endforeach</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		@else
		<p class="description-text"><span>Подробности за {{$activity->name}}:</span> {{$activity->description}}</p>
		@endif
	</div>
		<!--right side-->
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-6 col-sm-12">

		@if($gallery->isNotEmpty())
			<div class="h-section">
				<img src="{{asset('img/portfolio/fav.png')}}" alt="logo" class="logo-section">
				<h4 class="h-activity"><span>Снимки на {{ str_limit($activity->name, 20) }}</span></h4>
			</div>

			<div class="gallery-container">
				<div class="tz-gallery">
					<div class="col-sm-12 tz">
						@foreach($gallery as $photo)
							@if(file_exists('user_files/images/activity/gallery/' . $photo->image_path))
								<div class="col-xs-6 col-sm-6 col-md-4">
									<div class="marg">
										<a class="lightbox" href="{{ asset('user_files/images/activity/gallery/'.$photo->image_path)}}">
										<img src="{{ asset('user_files/images/activity/gallery/'.$photo->image_path)}}" alt="image" class="img-responsive" />
										</a>
									</div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
			</div>

		@endif
		</div>
		@if($gallery)
		<div class="col-md-6 col-sm-12 col-xs-12">
		@else
		<div class="col-md-6 col-sm-12 col-xs-12">
		@endif
		@php($category = $activity->category_id)
		@php($activityActivityId = $activity->activity_id)
		@php($subcat=$activities->where('subcategory_id',$activity->subcategory_id))
		@php($activitySubcategory = $activity->subcategory_id)

		<img src="{{asset('img/portfolio/fav.png')}}" alt="logo" class="logo-section">
			<div class="h-section">
				<h4 class="h-activity"><span>Предложения от категория {{$activity->category->name}}</span></h4>
			</div>
			<!-- slick-slider-->
			<div class="responsive">
					<!--single item-->

					@foreach($activities as $activ)
						@if(($activ->category_id == $category) && ($activ->activity_id != $activityActivityId) &&($activ->approved_at!=null) && ($activ->available == 1))
					<div>
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
										@isset($activ->organization->name)
										<em class="name">{{$activ->organization->name}}</em>
										@endisset
									</div>
								</div>
							</div>
						</a>
					</div>
						@endif
					@endforeach
				<!--end single item-->
			</div>
		</div>
	</div>
		<!--end right side-->
	<div class="col-md-12 col-sm-12 text-center">
        <a href="{{ url()->previous() }}" class="btn btn-box"><i class="fas fa-chevron-left"></i>&nbsp;Обратно</a>
    </div>
	</div>
	<!-- end main-container -->

@endsection
@section('og')
<meta property="og:title" content="{{ $activity->name }}" />
<meta property="og:image" content="@foreach($logo as $photo) @if($photo->image_path!='logo.png'){{ asset('user_files/images/activity/'.$photo->image_path)}} @endif @endforeach"/>
<meta property="og:type" content="{{$activity->description}}" />
@endsection
