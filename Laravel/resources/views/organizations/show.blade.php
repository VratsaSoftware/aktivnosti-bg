@extends('layouts.master')

@section('title', 'Организации')

@section('content')
<!-- main-container -->
    <div class="container main-container">
		<!-- left side -->
        <div class="col-md-6 col-sm-12">
            <!--pictures from Adobe Stock-->
            <div class="org-img">

                <img src="img/portfolio/vso-logo-bg.png" alt="activnost">

            </div>
            <div class="h-30"></div>
            <p><span>Нашата мисия:</span> Създаване на ИТ-общество във Враца, което чрез качествено образование дава възможност на врачани да работят предизвикателна и добре платена работа в родния си град.</p>
        </div>
		<!-- end left side -->
		<!-- right side -->
        <div class="col-md-6 col-sm-12">
            <h5 class="org"><span>Организация:&nbsp;&nbsp;</span>Враца софтуер общество</h5>
            <ul class="cat-ul">
                <li><i class="fas fa-calendar-alt"></i>Понеделник до петък от 9:00 до 18:00 ч.</li>
				<li><i class="fas fa-blog"></i>school.vratsasoftware.com</li>
                <li><i class="fas fa-envelope"></i>example@email.com</li>
                <li><i class="fas fa-mobile-alt"></i>0888 000000</li>
                <li><i class="fas fa-map-marked"></i>Враца, ул. Кокиче 14 </li>
                <li>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2908.188047764412!2d23.561882!3d43.205545!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xab9ab71f982bf1c5!2z0JjQoiDRhtC10L3RgtGK0YAgLSDQktGA0LDRhtCwINGB0L7RhNGC0YPQtdGA!5e0!3m2!1sen!2sus!4v1551269161962" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                </li>
            </ul>
            <!-- Subscribe button-->
            <div class="popup">
                <div class="popuptext" id="myPopup">
                    <div class="well">
                        <h3>Абонирайте се за още новини от Враца софтуер общество</h3>
                        <form action="#">
                            <div class="input-contact">
                                <input type="text" name="email">
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
		
		<!-- org activity -->
		<div class="col-md-12 col-sm-12">
			<h4 class="h-activity"><span>Активности на Враца софтуер общество</span></h4>
				<!-- single work -->
					<div class="col-md-4 col-sm-6 learnin free">
						<h4>Дигитален маркетинг</h4>
						<h5 class="org"><span>Водещ:&nbsp;&nbsp;</span>Алексей Потебня, Ивайло Йорданов</h5>
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
					<div class="col-md-4 col-sm-6 learning free">
						<h4>Уеб програмиране с PHP</h4>
						<h5 class="org"><span>Водещ:&nbsp;&nbsp;</span>Милена Томова</h5>
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
					<div class="col-md-4 col-sm-6 learning free">
						<h4>JAVA WEB & ANDROID</h4>
						<h5 class="org"><span>Водещ:&nbsp;&nbsp;</span>Тихомир Кръстев</h5>
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
			
		</div>
		<!-- end org activity -->
    </div>
    <!-- end main-container -->
@endsection