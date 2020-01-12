@extends('layouts.master')
@section('title', 'Нашият екип')
@section('content')
<div class="container py-5">
    <div class="row text-center text-white">
        <div class="col-lg-12 mx-auto">
           <p></p>
        </div>
    </div>
</div><!-- End -->


<div class="container">
    <div class="row text-center">

        <!-- Team item -->
        <div class="col-xl-6 col-sm-6 mb-5">
            <div class="bg-white rounded shadow-sm py-5 px-4"><img src="{{asset('img/team/emo.jpg')}}" alt="" width="250" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Емилиян Кадийски</h5><span class="small text-uppercase text-muted">Project Manager</span>
                <ul class="social mb-0 list-inline mt-3">
                    <li class="list-inline-item"><a href="https://www.facebook.com/e.kadiyski" target="_blank" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.linkedin.com/in/emiliyankadiyski" target="_blank" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div><!-- End -->

        <!-- Team item -->
        <div class="col-xl-3 col-sm-6 mb-5">
            <div class="bg-white rounded shadow-sm py-5 px-4"><img src="{{asset('img/team/default.webp')}}" alt="" width="250" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Светослав Василев</h5><span class="small text-uppercase text-muted">Mentor</span>
                <ul class="social mb-0 list-inline mt-3">
                    <li class="list-inline-item"><a href="#" target="_blank" class="social-link"><i class="fa fa-facebook-f"></i></a></li>          
                    <li class="list-inline-item"><a href="#" target="_blank" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div><!-- End -->

        <!-- Team item -->
        <div class="col-xl-3 col-sm-6 mb-5">
            <div class="bg-white rounded shadow-sm py-5 px-4"><img src="{{asset('img/team/default.webp')}}" alt="" width="250" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Борислав Кръстев</h5><span class="small text-uppercase text-muted">Developer</span>
                <ul class="social mb-0 list-inline mt-3">
                    <li class="list-inline-item"><a href="#" target="_blank" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a href="#" target="_blank" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div><!-- End -->

        <!-- Team item -->
        <div class="col-xl-3 col-sm-6 mb-5">
            <div class="bg-white rounded shadow-sm py-5 px-4"><img src="{{asset('img/team/default.webp')}}" alt="" width="250" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Ангел Ангелов</h5><span class="small text-uppercase text-muted">Developer</span>
                <ul class="social mb-0 list-inline mt-3">
                    <li class="list-inline-item"><a href="#" target="_blank" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a href="#" target="_blank" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div><!-- End -->
		
		 <!-- Team item -->
        <div class="col-xl-3 col-sm-6 mb-5">
            <div class="bg-white rounded shadow-sm py-5 px-4"><img src="{{asset('img/team/default.webp')}}" alt="" width="250" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Петя Вълчева</h5><span class="small text-uppercase text-muted">Developer</span>
                <ul class="social mb-0 list-inline mt-3">
                    <li class="list-inline-item"><a href="#" target="_blank" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a href="#" target="_blank" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div><!-- End -->
    </div>
</div>
@endsection