@extends('layouts.master')
@section('content')
    <!-- main container -->
    <div class="main-container portfolio-inner clearfix">
        <!-- portfolio div -->
        <div class="portfolio-div">
            <div class="portfolio">
                <!-- portfolio_filter -->
				<a href="#menu" id="toggle"><span></span></a>

				<div id="menu">
                <div class="categories-grid wow fadeInLeft">			
                    <nav class="categories text-center">
                        <ul class="portfolio_filter">
                            <li><a href="" onclick="javascript:ajaxLoad('{{url('/?cat=0')}}')" class="active" >Всички</a></li>
                            @foreach($categories as $category)
                            <li><a href="" id="category_id{{$category->category_id}}" onclick="javascript:ajaxLoad('{{url('/?cat='.$category->category_id)}}')">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                        <!--Slider-->
						
                        <div class="range_fancybox-wrap">
                            <div class="rangeslider-wrap">
                                <input type="range" onChange="ajaxLoad('{{url('/')}}?age='+this.value)" min="0" max="50" step="1" value="0" name="age" labels="Възраст">
                            </div>
                            <div class="fancybox">
								
                                <input name="free"type="checkbox" id="check" value="1" onChange="ajaxLoad('{{url('/')}}?free='+this.value)">
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
				</div>
                <!-- portfolio_filter -->
				
				<div id="content">
					@include('activities.index')
				</div>
			</div>
			<!-- portfolio -->
		</div>
		<!-- end portfolio div -->				
	</div>
    <!-- end main container -->
    <div id="preloaderA">
        <div class="pre-containerA">
            <div class="spinnerA">
                <div class="double-bounce1A"></div>
                <div class="double-bounce2A"></div>
            </div>
        </div>
    </div>
@endsection