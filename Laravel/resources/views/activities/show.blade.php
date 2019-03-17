@extends('layouts.master')

@section('title', 'Fly yoga')

@section('content')
		
		<!-- main-container -->
		<div class="container main-container">
			<div class="col-md-7 col-sm-12">
			   <!--pictures from Adobe Stock-->
				<div class="slideshow-container">
					<div class="mySlides1">
						<img src="{{asset("img/portfolio/flyioga1.jpg")}}" alt="activnost">
					</div>

					<div class="mySlides1">
						<img src="{{asset("img/portfolio/flyioga2.jpg")}}" alt="activnost">
					</div>
					<a class="previmg" onclick="plusSlides(-1, 0)">&#10094;</a>
					<a class="nextimg" onclick="plusSlides(1, 0)">&#10095;</a>
				</div>
				<div class="h-30"></div>
			</div>

			<div class="col-md-5 col-sm-12">
				<h3 class="text-uppercase">Fly yoga</h3>
				<h5 class="org"><span>Водещ:&nbsp;&nbsp;</span>Петя Димитрова и Петя</h5>
				<a href="org.html"><h5 class="org"><span>Организация:&nbsp;&nbsp;</span>ET Петя Димитрова</h5></a>
			</div>
			<div class="col-md-5 col-sm-12">
				<ul class="cat-ul">
					<li><i class="fas fa-calendar-alt"></i><a href="schedule.html" target="_blank">Вторник и четвъртък от 18:30 до 20:00 ч. Събота от 9:00 до 10:30 ч.</a></li>
					<li><i class="fas fa-tasks"></i>Носете си: <span class="task">спортно облекло</span></li>
					<li><i class="fas fa-envelope"></i>example@email.com</li>
					<li><i class="fas fa-mobile-alt"></i>0888 000000</li>
					<li><i class="fas fa-map-marked"></i>Враца, ул. Цар Обединител 9</li>
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
				<h4>Подобни активности</h4>
					<!-- slick-slider-->
				<div class="slider_item">
					<section class="regular slider">
						<!--single item-->
						<div>
							<a href="single-project.html" class="portfolio_item">
								<img src="{{asset("img/portfolio/joga.png")}}" alt="image" class="img-responsive" />
								<div class="portfolio_item_hover">
									<div class="portfolio-border clearfix">
										<div class="item_info">
											<span class="description">Йога</span>
											<em class="name">Йога студио Пракрити</em>
										</div>
									</div>
								</div>
							</a>
						</div>
					<!--end single item-->
					</section>
				</div>
				<!-- end slick-slider-->
			
				
			</div>
			<div class="col-md-7 col-sm-12">
				<p>
					Не е просто йога, а час за вълнуващо предизвикателство и забавление. Това е съчетание на
					класически йога пози, върху йога-хамак с нов подход и начин на изпълнение.
					Обърнатите пози се изпълняват безопасно, без да се натоварва гръбначния стълб.
					Благодарение на висенето тялото се разтяга с лекота, без напрежение и без натиск,
					използвайки силата на гравитацията. Чрез висенето се увеличава подвижността на ставите,
					отварят се между прешлените пространства, коригират се изкривяванията на гръбначния стълб,
					облекчават се болките в гърба.
				</p>

				<p>
					Петя Димитрова се занимава с йога от осемнайсет години, а води групи възрастни и деца от
					2010 година.
					Инструктор по йога със свидетелство за професионална квалификация към треньорски
					факултет на НСА “В. Левски” – София и сертификат за завършен практически курс “Yoga fly за
					деца” към същата академия. 
				</p>
			</div>
			<!--right side-->
				<div class="col-md-5 col-sm-12">
					<h4>Предложения от категория спорт</h4>
					<!-- slick-slider-->
					<div class="slider_item">
						<section class="regular slider">
							<div>
								<a href="single-project.html" class="portfolio_item">
									<img src="{{asset("img/portfolio/fcbotev.png")}}" alt="image" class="img-responsive" />
									<div class="portfolio_item_hover">
										<div class="portfolio-border clearfix">
											<div class="item_info">
												<span class="description">Тренировки по футбол</span>
												<em class="name">ФК Ботев Враца</em>
											</div>
										</div>
									</div>
								</a>
							</div>		
							<div>
								<a href="single-project.html" class="portfolio_item">
									<img src="{{asset("img/portfolio/bcbotev.png")}}" alt="image" class="img-responsive" />
									<div class="portfolio_item_hover">
										<div class="portfolio-border clearfix">
											<div class="item_info">
												<span class="description">Тренировки по баскетбол</span>
												<em class="name">БК Ботев Враца</em>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div>
								<a href="single-project.html" class="portfolio_item">
									<img src="{{asset("img/portfolio/vcbotev.png")}}" alt="image" class="img-responsive" />
									<div class="portfolio_item_hover">
										<div class="portfolio-border clearfix">
											<div class="item_info">
												<span class="description">Тренировки по волейбол</span>
												<em class="name">ВК Ботев Враца</em>
											</div>
										</div>
									</div>
								</a>
							</div>
							<div>
								<a href="single-project.html" class="portfolio_item">
									<img src="{{asset("img/portfolio/joga.png")}}" alt="image" class="img-responsive" />
									<div class="portfolio_item_hover">
										<div class="portfolio-border clearfix">
											<div class="item_info">
												<span class="description">Йога</span>
												<em class="name">Йога студио Пракрити</em>
											</div>
										</div>
									</div>
								</a>
							</div>
							
						</section>
					</div>
					<!-- end slick-slider-->
					<!--social list-->
					<h4 class="social-h4">Сподели</h4>
					<ul class="social-ul">
						<li class="box-social"><a href="#0"><i class="fab fa-facebook-f"></i></a></li>
						<li class="box-social"><a href="#0"><i class="fab fa-instagram"></i></a></li>
						<li class="box-social"><a href="#0"><i class="fab fa-google-plus-g"></i></a></li>
						<li class="box-social"><a href="#0"><i class="fab fa-twitter"></i></a></li>
					</ul>
					<!--end social list-->
				</div>	
				<!--end right side-->		
		</div>
		<!-- end main-container -->

@endsection