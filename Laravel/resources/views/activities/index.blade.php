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
                            <li><a href="" data-filter=".sport">Спорт</a></li>
                            <li><a href="" data-filter=".learning">Обучение</a></li>
                            <br id="new_row_1">
                            <li><a href="" data-filter=".dance">Танци</a></li>
                            <li><a href="" data-filter=".graphics">Развлечения</a></li>
                            <li><a href="" data-filter=".art">Изкуство</a></li>
                        </ul>
                        <!--Slider-->
                        <div class="range_fancybox-wrap">
                            <div class="rangeslider-wrap">
                                <input type="range" min="0" max="50" step="1" value="0" labels="Възраст">
                            </div>
                            <div class="fancybox">
                                <input type="checkbox" id="check" />
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
					<!-- single work -->
					<div class="col-md-3 col-sm-6 learning free item-box">
						
						<a href="single-project.html" class="portfolio_item">
							<div class="offert">Безплатен</div>
							<img src="img/portfolio/vso1.png" alt="image" class="img-responsive" />
							<div class="portfolio_item_hover">
								<div class="portfolio-border clearfix">
									<div class="item_info">
										<span>4-месечен курс по дигитален маркетинг</span>
										<em>Враца софтуер общество</em>
									</div>
								</div>
								<!-- item logo-->
								<div class="item_logo">
									<img src="img/portfolio/studentlogo.png" alt="logo">
								</div>
								<!-- end item logo-->
							</div>
						</a>
					</div>
					<!-- end single work -->

					<!-- single work -->
					<div class="col-md-3 col-sm-6 learning free item-box">
						<a href="single-project.html" class="portfolio_item">
							<div class="offert">Безплатен</div>
							<img src="img/portfolio/vso.png" alt="image" class="img-responsive" />
							<div class="portfolio_item_hover">
								<div class="portfolio-border clearfix">
									<div class="item_info">
										<span>9-месечен курс по програмиране</span>
										<em>Враца софтуер общество</em>
									</div>
								</div>
								<!-- item logo-->
								<div class="item_logo">
									<img src="img/portfolio/studentlogo.png" alt="logo">
								</div>
								<!-- end item logo-->
							</div>
						</a>
					</div>
					<!-- end single work -->

					<!-- single work -->
					<div class="col-md-3 col-sm-6 art item-box">
						<a href="single-project.html" class="portfolio_item">
							<div class="offert">Безплатен</div>
							<img src="img/portfolio/temp.png" alt="image" class="img-responsive" />
							<div class="portfolio_item_hover">
								<div class="portfolio-border clearfix">
									<div class="item_info">
										<span>Театрална група ТЕМП</span>
										<em>Младежки дом</em>
									</div>
								</div>
								<!-- item logo-->
								<div class="item_logo">
									<img src="img/portfolio/artistlogo.png" alt="logo">
									<img src="img/portfolio/dancerlogo.png" alt="logo">
								</div>
								<!-- end item logo-->
							</div>
						</a>
					</div>
					<!-- end single work -->

					<!-- single work -->
					<div class="col-md-3 col-sm-6 sport item-box">
						<a href="single-project.html" class="portfolio_item">
							<div class="offert">Безплатен</div>
							<img src="img/portfolio/fcbotev.png" alt="image" class="img-responsive" />
							<div class="portfolio_item_hover">
								<div class="portfolio-border clearfix">
									<div class="item_info">
										<span>Тренировки по футбол</span>
										<em>ПОФК Ботев Враца</em>
									</div>
								</div>
								<!-- item logo-->
								<div class="item_logo">
									<img src="img/portfolio/athletelogo.png" alt="logo">
								</div>
								<!-- end item logo-->
							</div>
						</a>
					</div>
					<!-- end single work -->

					<!-- single work -->
					<div class="col-md-3 col-sm-6 dance item-box">
						<a href="single-project.html" class="portfolio_item">
							<div class="offert">Безплатен</div>
							<img src="img/portfolio/nakov.png" alt="image" class="img-responsive" />
							<div class="portfolio_item_hover">
								<div class="portfolio-border clearfix">
									<div class="item_info">
										<span>Народни танци</span>
										<em>Dance center Nankov</em>
									</div>
								</div>
								<!-- item logo-->
								<div class="item_logo">
									<img src="img/portfolio/dancerlogo.png" alt="logo">
								</div>
								<!-- end item logo-->
							</div>
						</a>
					</div>
					<!-- end single work -->

					<!-- single work -->
					<div class="col-md-3 col-sm-6 dance item-box">
						<a href="single-project.html" class="portfolio_item">
							<div class="offert">Безплатен</div>
							<img src="img/portfolio/zumba.jpg" alt="image" class="img-responsive" />
							<div class="portfolio_item_hover">
								<div class="portfolio-border clearfix">
									<div class="item_info">
										<span>Зумба танци</span>
										<em>СК харизма тийм</em>
									</div>
								</div>
								<!-- item logo-->
								<div class="item_logo">
									<img src="img/portfolio/dancerlogo.png" alt="logo">
								</div>
								<!-- end item logo-->
							</div>
						</a>
					</div>
					<!-- end single work -->

					<!-- single work -->
					<div class="col-md-3 col-sm-6 sport item-box">
						<a href="single-project.html" class="portfolio_item">
							<div class="offert">Безплатен</div>
							<img src="img/portfolio/bcbotev.png" alt="image" class="img-responsive" />
							<div class="portfolio_item_hover">
								<div class="portfolio-border clearfix">
									<div class="item_info">
										<span>Тренировки по баскетбол</span>
										<em>БК Ботев Враца</em>
									</div>
								</div>
								<!-- item logo-->
								<div class="item_logo">
									<img src="img/portfolio/athletelogo.png" alt="logo">
								</div>
								<!-- end item logo-->
							</div>
						</a>
					</div>
					<!-- end single work -->

					<!-- single work -->
					<div class="col-md-3 col-sm-6 sport item-box">
						<a href="single-project.html" class="portfolio_item">
							<div class="offert">Безплатен</div>
							<img src="img/portfolio/vcbotev.png" alt="image" class="img-responsive" />
							<div class="portfolio_item_hover">
								<div class="portfolio-border clearfix">
									<div class="item_info">
										<span>Тренировки по волейбол</span>
										<em>ВК Ботев Враца</em>
									</div>
								</div>
								<!-- item logo-->
								<div class="item_logo">
									<img src="img/portfolio/athletelogo.png" alt="logo">
								</div>
								<!-- end item logo-->
							</div>
						</a>
					</div>
					<!-- end single work -->

					<!-- single work -->
					<div class="col-md-3 col-sm-6 sport item-box">
						<a href="single-project.html" class="portfolio_item">
							<div class="offert">Безплатен</div>
							<img src="img/portfolio/joga.png" alt="image" class="img-responsive" />
							<div class="portfolio_item_hover">
								<div class="portfolio-border clearfix">
									<div class="item_info">
										<span>Йога</span>
										<em>Йога студио Пракрити</em>
									</div>
								</div>
								<!-- item logo-->
								<div class="item_logo">
									<img src="img/portfolio/athletelogo.png" alt="logo">
								</div>
								<!-- end item logo-->
							</div>
						</a>
					</div>
					<!-- end single work -->

					<!-- single work -->
					<div class="col-md-3 col-sm-6 sport item-box">
						<a href="single-project.html" class="portfolio_item">
							<div class="offert">Безплатен</div>
							<img src="img/portfolio/flyioga1.jpg" alt="image" class="img-responsive" />
							<div class="portfolio_item_hover">
								<div class="portfolio-border clearfix">
									<div class="item_info">
										<span>Fly Yoga</span>
										<em>С Петя Димитрова</em>
									</div>
								</div>
								<!-- item logo-->
								<div class="item_logo">
									<img src="img/portfolio/athletelogo.png" alt="logo">
								</div>
								<!-- end item logo-->
							</div>
						</a>
					</div>
					<!-- end single work -->

					<!-- single work -->
					<div class="col-md-3 col-sm-6 learning item-box">
						<a href="single-project.html" class="portfolio_item">
							<div class="offert">Безплатен</div>
							<img src="img/portfolio/angl.jpg" alt="image" class="img-responsive" />
							<div class="portfolio_item_hover">
								<div class="portfolio-border clearfix">
									<div class="item_info">
										<span>Уроци по английски</span>
										<em>Езикова школа АНГЛЕЛАНД</em>
									</div>
								</div>
								<!-- item logo-->
								<div class="item_logo">
									<img src="img/portfolio/studentlogo.png" alt="logo">
								</div>
								<!-- end item logo-->
							</div>
						</a>
					</div>
					<!-- end single work -->
				</div>
					
				<!-- end portfolio_container -->
            </div>
            <!-- portfolio -->
        </div>
        <!-- end portfolio div -->
    </div>
    <!-- end main container -->
@endsection