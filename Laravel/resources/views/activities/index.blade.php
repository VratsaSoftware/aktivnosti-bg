@extends('layouts.master')

@section('content')

    <!-- main container -->
    <div class="main-container portfolio-inner clearfix">
        <!-- portfolio div -->
        <div class="portfolio-div">
            <div class="portfolio">
                <!-- portfolio_filter -->
                <div class="categories-grid wow fadeInLeft">
                    <nav class="categories text-center">
                        <ul class="portfolio_filter">
                            <li><a href="" class="active" data-filter="*">Всички</a></li>
                            @foreach($categories as $category)
                            <li><a href="" data-filter=".{{$category->name}}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                        <!--Slider-->
                        <div class="range_fancybox-wrap">
                            <div class="rangeslider-wrap">
                                <input type="range" min="0" max="50" step="1" value="0" labels="Възраст">
                            </div>
                            <div class="fancybox">
                                <input type="checkbox" id="check">
                                <label for="check">
                                    <svg viewBox="0,0,50,50">
                                        <path d="M5 30 L 20 45 L 45 5"></path>
                                    </svg>
                                </label>
                                <p class="">Безплатни</p>
                            </div>
                        </div>
                    </nav>
                </div>
                <!-- portfolio_filter -->
				
				<!-- portfolio_container -->
				<div class="no-padding portfolio_container clearfix">
					
					@foreach($activities as $activity)
						@if(isset($activity->approved_at) && ($activity->available == 1))
						<div class="col-md-3 col-sm-6 col-xs-12 @isset($activity->category->name){{$activity->category->name}}@endisset">	
							<a href="{{ route('activities.show', $activity->activity_id)}}" class="portfolio_item">
								@if(!$activity->price)
									<div class="offert">Безплатен</div>
								@endif
								@foreach ($activity->photos as $photo)
									@if ($photo->purpose->description == 'mine')
										<img class="activity-img"src="{{ asset('user_files/images/activity/' . $photo->image_path) }}" alt="{{$photo->alt}}" class="img-responsive" />
									@endif
								@endforeach
								<div class="portfolio_item_hover">
									<div class="portfolio-border clearfix">
										<div class="item_info">
											<span>{{$activity->name}}</span>
											@isset($activity->organization->name)
											<em>{{$activity->organization->name}}</em>
											@endisset
										</div>
									</div>
									<!-- item logo-->
									<div class="item_logo">
									@isset($activity->category->name)
										<img src="{{asset('img/portfolio/'.$activity->category->description)}}" alt="logo">
									@endisset
									</div> 
									<!-- end item logo-->
								</div>
								<div class="item-description">
									<h5>{{$activity->name}}</h5>
								</div>
							</a>
						</div>
						@endif
					@endforeach	
				</div>					
				<!-- end portfolio_container -->
				
            </div>
            <!-- portfolio -->
        </div>
        <!-- end portfolio div -->
		{{$activities->links()}}
    </div>
    <!-- end main container -->
@endsection