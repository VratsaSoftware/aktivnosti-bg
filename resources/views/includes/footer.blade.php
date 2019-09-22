	<!-- footer -->
	@php($organization = App\Models\Organization::select()->where('name', 'Aktivnosti.bg')->whereNotNull('approved_at')->first())
	<footer class="footer-section">
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="widget company-intro-widget">
							<a href="{{route('activities.index')}}" class="site-logo"><img src="{{asset('img/logo.png')}}" alt="logo"></a>
							@if(isset($organization->description))
							<p>{{$organization->description}}</p>
							@else
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>
							@endif
							<ul class="company-footer-contact-list">
								@if(isset($organization->email))
								<li><i class="fas fa-envelope"></i>{{$organization->email}}</li>
								@else
								<li><i class="fas fa-envelope"></i>contacts@aktivnosti.bg</li>
								@endif
							</ul>
						</div>
					</div><!-- widget end -->
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="widget course-links-widget">
							<h5 class="widget-title">Популярни активности</h5>
							<ul class="courses-link-list">
								@foreach(App\Models\Activity::latest()->paginate(5) as $activity)
									@if($activity->approved_at != null)
								<li><a href="{{ route('activities.show', $activity->activity_id)}}"><i class="fas fa-long-arrow-alt-right"></i>{{$activity->name}}</a></li>
									@endif
								@endforeach
							</ul>
						</div>
					</div><!-- widget end -->
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="widget latest-news-widget">
							<h5 class="widget-title">Полезни връзки</h5>
							<ul class="small-post-list">
								<li>
									<div class="small-post-item">
										<a href="{{route('activities.index')}}" class="post-date">Активности</a>
									</div>
								</li><!-- small-post-item end -->
								<li>
									<div class="small-post-item">
										<a href="{{route('organizations.index')}}" class="post-date">Организации</a>
									</div>
								</li><!-- small-post-item end -->
								<li>
									<div class="small-post-item">
										<a href="{{route('news.index')}}" class="post-date">Новини</a>
									</div>
								</li><!-- small-post-item end -->
								<li>
									<div class="small-post-item">
										<a href="#" class="post-date">Условия за ползване</a>
									</div>
								</li><!-- small-post-item end -->
								<li>
									<div class="small-post-item">
										<a href="#" class="post-date">Екип</a>
									</div>
								</li><!-- small-post-item end -->
							</ul>
						</div>
					</div><!-- widget end -->
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="widget newsletter-widget">
							<h5 class="widget-title">Newsletter</h5>
							<div class="footer-newsletter">
								<p>Абонирайте се за нашите новини</p>
								<form class="news-letter-form" method="POST" action="{{ route('subscription.store') }}" enctype="multipart/form-data">
								@csrf
									<input type="email" name="email" id="news-email" placeholder="Вашият имейл">
									@foreach(App\Models\Category::all() as $category)
                                        <input name="category_id[]" type="hidden" value="{{$category->category_id}}">
                                    @endforeach
									<input type="submit" value="Изпрати">
								</form>
						</div>
						</div>
					</div><!-- widget end -->
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 text-sm-left text-center">
						<span class="copy-right-text">© {{date("Y")}}<a href="{{route('activities.index')}}"> Aktivnosti.bg </a> All Rights Reserved.</span>
					</div>
				</div>
			</div>
		</div><!-- footer-bottom end -->
	</footer>
	<!-- end footer -->
