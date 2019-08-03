				<!-- portfolio_container -->
				<div class="no-padding portfolio_container clearfix">
				@foreach($activities as $activity)

					@if(isset($activity->approved_at) && ($activity->available == 1))

					<div data-aos="zoom-in" class="col-md-3 col-sm-6 col-xs-12 @isset($activity->category->name){{$activity->category->name}}@endisset">
						<a href="{{ route('activities.show', $activity->activity_id)}}" class="portfolio_item ">
							@if(!$activity->price)
								<div class="offert">Безплатен</div>
							@endif

							@foreach ($activity->photos as $photo)
								@if ($photo->purpose->description == 'mine')
									<img class="activity-img"src="{{ asset('user_files/images/activity/' . $photo->image_path) }}" alt="{{$photo->alt}}" class="img-responsive" />
									@break
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
								<i class="fas fa-eye"></i>
								<h5>{{str_limit($activity->name, 65)}}</h5>
							</div>
						</a>
					</div>

					@endif
				@endforeach
				</div>
				<!-- paginate -->
				{{$activities->links()}}
			<!-- end portfolio_container -->
