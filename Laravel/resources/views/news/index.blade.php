@extends('layouts.master')

@section('title', 'Новини')

@section('content')
		<!-- main-container -->
		
	<div class=" container main-container">
		<!-- itemslimits -->
		<div class="container col-md-12"> 
		
			<div class="container col-md-2 select"> 	<!--		Show Numbers Of Rows 		-->
				<select name="state" id="maxRows">
					 <option value="5000">покажи &#8734;</option>
					 <option value="6">покажи 6</option>
					 <option value="9">покажи 9</option>
					 <option value="12">покажи 12</option>
					 <option value="15">покажи 15</option>
					 <option value="50">покажи 60</option>
					 <option value="70">покажи 90</option>
				</select>			
			</div>
		</div>
		<!-- end itemslimits -->
        <div class="clearfix table table-striped table-class" id= "table-id">
		<div>
			<!-- single news-->
			<div class="col-md-4 col-sm-6 service-box">
				<!-- service-box -->
					
					<img src="img/portfolio/06.jpg" alt="pic">
					<h3>Заглавие на новина</h3>
					<div class="h-10"></div>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliter enim nosmet ipsos nosse non possumus. Inscite autem medicinae </p>
				
				<!-- end service-box -->
				<!-- Trigger the modal with a button -->
				<button type="button" class="btn btn-box" data-toggle="modal" data-target="#myModal">Прочети</button>

				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
				@include('news.show')
						</div>
					</div>
				</div>
			
            </div>
			<!-- end single news-->
            <!-- single news-->
			<div class="col-md-4 col-sm-6 service-box">
					<!-- service-box -->
					
					<img src="img/portfolio/02.jpg" alt="pic">
					<h3>Заглавие на новина</h3>
					<div class="h-10"></div>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliter enim nosmet ipsos nosse non possumus. Inscite autem medicinae </p>
				
				<!-- end service-box -->
				<!-- Trigger the modal with a button -->
				<button type="button" class="btn btn-box" data-toggle="modal" data-target="#myModal">Прочети</button>

				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
				@include('news.show')
						</div>
					</div>
				</div>
            </div>
			<!-- end single news-->
			<!-- single news-->
			<div class="col-md-4 col-sm-6 service-box">
					<!-- service-box -->
					
					<img src="img/portfolio/04.jpg" alt="pic">
					<h3>Заглавие на новина</h3>
					<div class="h-10"></div>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliter enim nosmet ipsos nosse non possumus. Inscite autem medicinae </p>
				
				<!-- end service-box -->
				<!-- Trigger the modal with a button -->
				<button type="button" class="btn btn-box" data-toggle="modal" data-target="#myModal">Прочети</button>

				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
				@include('news.show')
						</div>
					</div>
				</div>
            </div>
			<!-- end single news-->
			<!-- single news-->
			<div class="col-md-4 col-sm-6 service-box">
					<!-- service-box -->
					
					<img src="img/portfolio/03.jpg" alt="pic">
					<h3>Заглавие на новина</h3>
					<div class="h-10"></div>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliter enim nosmet ipsos nosse non possumus. Inscite autem medicinae </p>
				
				<!-- end service-box -->
				<!-- Trigger the modal with a button -->
				<button type="button" class="btn btn-box" data-toggle="modal" data-target="#myModal">Прочети</button>

				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
				@include('news.show')
						</div>
					</div>
				</div>
            </div>
			<!-- end single news-->
			<!-- single news-->
			<div class="col-md-4 col-sm-6 service-box">
					<!-- service-box -->
					
					<img src="img/portfolio/02.jpg" alt="pic">
					<h3>Заглавие на новина</h3>
					<div class="h-10"></div>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliter enim nosmet ipsos nosse non possumus. Inscite autem medicinae </p>
				
				<!-- end service-box -->
				<!-- Trigger the modal with a button -->
				<button type="button" class="btn btn-box" data-toggle="modal" data-target="#myModal">Прочети</button>

				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
				@include('news.show')
						</div>
					</div>
				</div>
            </div>
			<!-- end single news-->
			<!-- single news-->
			<div class="col-md-4 col-sm-6 service-box">
					<!-- service-box -->
					
					<img src="img/portfolio/01.jpg" alt="pic">
					<h3>Заглавие на новина</h3>
					<div class="h-10"></div>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliter enim nosmet ipsos nosse non possumus. Inscite autem medicinae </p>
				
				<!-- end service-box -->
				<!-- Trigger the modal with a button -->
				<button type="button" class="btn btn-box" data-toggle="modal" data-target="#myModal">Прочети</button>

				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
				@include('news.show')
						</div>
					</div>
				</div>
            </div>
			<!-- end single news-->
			<!-- single news-->
			<div class="col-md-4 col-sm-6 service-box">
					<!-- service-box -->
					
					<img src="img/portfolio/05.jpg" alt="pic">
					<h3>Заглавие на новина</h3>
					<div class="h-10"></div>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliter enim nosmet ipsos nosse non possumus. Inscite autem medicinae </p>
				
				<!-- end service-box -->
				<!-- Trigger the modal with a button -->
				<button type="button" class="btn btn-box" data-toggle="modal" data-target="#myModal">Прочети</button>

				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
				@include('news.show')
						</div>
					</div>
				</div>
            </div>
			<!-- end single news-->
			<!-- single news-->
			<div class="col-md-4 col-sm-6 service-box">
					<!-- service-box -->
					
					<img src="img/portfolio/02.jpg" alt="pic">
					<h3>Заглавие на новина</h3>
					<div class="h-10"></div>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliter enim nosmet ipsos nosse non possumus. Inscite autem medicinae </p>
				
				<!-- end service-box -->
				<!-- Trigger the modal with a button -->
				<button type="button" class="btn btn-box" data-toggle="modal" data-target="#myModal">Прочети</button>

				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
				@include('news.show')
						</div>
					</div>
				</div>
            </div>
			<!-- end single news-->
			<!-- single news-->
			<div class="col-md-4 col-sm-6 service-box">
					<!-- service-box -->
					
					<img src="img/portfolio/05.jpg" alt="pic">
					<h3>Заглавие на новина</h3>
					<div class="h-10"></div>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliter enim nosmet ipsos nosse non possumus. Inscite autem medicinae </p>
				
				<!-- end service-box -->
				<!-- Trigger the modal with a button -->
				<button type="button" class="btn btn-box" data-toggle="modal" data-target="#myModal">Прочети</button>

				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
				@include('news.show')
						</div>
					</div>
				</div>
            </div>
			<!-- end single news-->
			<!-- single news-->
			<div class="col-md-4 col-sm-6 service-box">
					<!-- service-box -->
					
					<img src="img/portfolio/02.jpg" alt="pic">
					<h3>Заглавие на новина</h3>
					<div class="h-10"></div>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliter enim nosmet ipsos nosse non possumus. Inscite autem medicinae </p>
				
				<!-- end service-box -->
				<!-- Trigger the modal with a button -->
				<button type="button" class="btn btn-box" data-toggle="modal" data-target="#myModal">Прочети</button>

				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
				@include('news.show')
						</div>
					</div>
				</div>
            </div>
			<!-- end single news-->
        </div>
		</div>
		<!--		Start Pagination -->
		<div class='pagination-container' >
			<nav>
				<ul class="pagination">

					<li data-page="prev" >
						<span> < <span class="sr-only">(current)</span></span>
					</li>
					<!--	Here the JS Function Will Add the Rows -->
					<li data-page="next" id="prev">
						 <span> > <span class="sr-only">(current)</span></span>
					</li>
				</ul>
			</nav>
		</div>

	</div> 
   
    <!-- end main-container -->

@endsection