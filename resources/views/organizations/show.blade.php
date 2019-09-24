@extends('layouts.master')

@section('title', $organization->name)

@section('content')

@push('head')
    <!-- Maps support -->
    <script>
        //prepare variables for js
        var latitude,
            longitude,
            auth = '{{ env("MAP_KEY",'') }}',
            city = '{{ $organization->city->name }}',
            address = '{{ str_replace(str_split('\\/:*?"<>|$!@'),'',$organization->address) }}';
    </script>
    <script src="{{ asset('js/map.js') }}"></script>
	
    <script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap' async defer></script>
@endpush

<!-- main-container -->
    <div class="container main-container">
        <!-- left side -->
        <div class="col-md-6 col-sm-6 col-xs-12">

            <!--pictures from Adobe Stock-->
            <div class="act-img portfolio_item">

            @if(count($logo)!=0)
            @foreach($logo->sortByDesc('updated_at') as $photo)
                @if($photo->image_path!='logo.png')
                <img src="{{ asset('user_files/images/organization/'.$photo->image_path)}}" alt="{{ $photo->description }}">
                @break
                @endif
            @endforeach
            @else
                <img src="{{ asset('/img/portfolio/logo2.jpg')}}" alt="logo">
            @endif
            </div>
            <div class="h-30"></div>
        </div>
        <!-- end left side -->
        <!-- right side -->
        <div class="col-md-6 col-sm-6 col-xs-12">
            <h5 class="org"><span>Организация:&nbsp;&nbsp;</span>{{ $organization->name }}</h5>
            <ul class="cat-ul">
                @if($organization->website)
                <li><i class="fas fa-blog"></i>{{ $organization->website }}</li>
                @endif
                <li><i class="fas fa-envelope"></i>{{ $organization->email }}</li>
                <li><i class="fas fa-mobile-alt"></i>{{ $organization->phone }}</li>
                <li><i class="fas fa-map-marked"></i>{{ $organization->address }}</li>
                <li>
                    <div id="myMap" style="position:relative;width:100%;height:200px;"></div>
                </li>
            </ul>
            <!-- Subscribe button-->
            <div class="popup">
                <div class="popuptext" id="myPopup">
                    <div class="well">
                        <h3>Абонирайте се за още новини от {{ $organization->name }}</h3>
                        <form method="POST" action="{{ route('organizations.subscribe') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="input-contact">
                                <input type="email" name="email">
                                <span>Вашият имейл</span>
                            </div>
                            <div class="button-group">
                                <button href="#" class="btn btn-box">Изпрати</button>
                            </div>
                            <input type="hidden" name="organization_id" value="{{$organization->organization_id}}">
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
        <!-- end right side -->
        <div class="col-md-12 col-sm-12">
            <p class="description-text"><span>За организацията:</span> {{ $organization->description }}</p>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="h-section">
                    <img src="{{asset('img/portfolio/fav.png')}}" alt="logo" class="logo-section">
                    <h4 class="h-activity"><span>Снимки на {{ str_limit( $organization->name, 15) }}</span></h4>
                </div>
                @php $countExistingPics = 0; @endphp
                @if(count($gallery) != 0)
                <div class="gallery-container">
                    <div class="tz-gallery">
                        <div class="tz">
                            @foreach($gallery as $photo)
                                @if(file_exists('user_files/images/organization/gallery/' . $photo->image_path))
                                    <div class="col-xs-6 col-sm-6 col-md-4">
                                        <div class="marg gallery">
                                            <a class="lightbox" href="{{ asset('user_files/images/organization/gallery/'.$photo->image_path)}}">
                                                <img src="{{ asset('user_files/images/organization/gallery/'.$photo->image_path)}}" alt="image" class="img-responsive" />
                                            </a>
                                        </div>
                                    </div>
                                    @php $countExistingPics += 1; @endphp
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                @if( $countExistingPics == 0)
                    <h5>Няма добавени снимки</h5>
                @endif
            </div>
            <!-- org activity -->
            <div class="col-md-6 col-sm-12 col-xs-12">
            @if(count($activities->all())!=0)
                <div class="h-section">
                    <img src="{{asset('img/portfolio/fav.png')}}" alt="logo" class="logo-section">
                    <h4 class="h-activity"><span>Активности на {{str_limit( $organization->name, 15) }}</span></h4>
                </div>
                <div class="responsive">
                    <!-- single work -->
                    @foreach($activities as $activity)
                    <div>
                        <a href="{{route('activities.show', $activity->activity_id)}}" class="portfolio_item">
                            @foreach ($activity->photos as $photo)
                                @if ($photo->purpose->description == 'mine')
                            <img class="activity-img" src="{{ asset('user_files/images/activity/' . $photo->image_path) }}" alt="{{$photo->alt}}" class="img-responsive" />
                                @endif
                            @endforeach
                            <div class="portfolio_item_hover">
                                <div class="portfolio-border clearfix">
                                    <div class="item_info">
                                        <span>{{str_limit( $activity->name, 15)}}</span>
                                    </div>
                                </div>
                                <!-- item logo-->
                                <div class="item_logo">
                                    @isset($activity->category->description)
                                        <img src="{{asset('img/portfolio/'.$activity->category->description)}}" alt="logo">
                                    @endisset
                                </div>
                                <!-- end item logo-->
                            </div>
                        </a>
                    </div>
                        @endforeach
                    <!-- end single work -->
                </div>
            @endif
            </div>
        </div>       
        <!-- end org activity -->
    </div>
	<div class="text-center">
          <a href="{{ url()->previous() }}" class="btn btn-box"><i class="fas fa-chevron-left"></i>&nbsp;Обратно</a>
    </div>
    <script>

	$(function() {
		$(".img-w").each(function() {
		$(this).wrap("<div class='img-c'></div>")
		let imgSrc = $(this).find("img").attr("src");
		$(this).css('background-image', 'url(' + imgSrc + ')');
	})


  $(".img-c").click(function() {
    let w = $(this).outerWidth()
    let h = $(this).outerHeight()
    let x = $(this).offset().left
    let y = $(this).offset().top


    $(".active").not($(this)).remove()
    let copy = $(this).clone();
    copy.insertAfter($(this)).height(h).width(w).delay(500).addClass("active")
    $(".active").css('top', y - 8);
    $(".active").css('left', x - 8);

      setTimeout(function() {
    copy.addClass("positioned")
  }, 0)

  })
})

$(document).on("click", ".img-c.active", function() {
  let copy = $(this)
  copy.removeClass("positioned active").addClass("postactive")
  setTimeout(function() {
    copy.remove();
  }, 500)
})
    </script>
    <!-- end main-container -->
@endsection
@section('og')
<meta property="og:title" content="{{ $organization->name }}" />
<meta property="og:image" content="@if(count($logo)!=0) @foreach($logo as $photo) @if($photo->image_path!='logo.png'){{ asset('user_files/images/organization/'.$photo->image_path)}} @endif @endforeach @else {{ asset('/img/portfolio/logo2.jpg')}} @endif"/>
<meta property="og:type" content="{{$organization->description}}" />
@endsection
