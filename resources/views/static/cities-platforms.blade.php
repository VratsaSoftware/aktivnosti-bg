@extends('layouts.master')

@section('title', 'Избери твоя град')

@section('content')
    <div class="text-center" style="font-size: 20px">
        Целта на <b>aktivnosti.bg</b> е да събере на едно място възможностите за <br>
        практикуване на хобита като спорт, танци, изкуства и учене в малки градове на България.
    </div>
    <div class="clearfix">
        @foreach($cities as $city)
            <div data-aos="zoom-in" class="portfolio col-md-4 col-sm-6 col-xs-12" style="margin-top: 28px">
                <a href="{{ $city->platformUrl }}" class="portfolio_item">
                    <img class="activity-img img-responsive"
                         src="{{ asset('img/cities/' . $city->photo_path) }}" style="height: 352px!important;"
                         alt=""/>

                    <div class="portfolio_item_hover">
                        <div class="portfolio-border clearfix">
                            <div class="item_info">
                                <span>{{ $city->name }}</span>
                                <em>Виж</em>
                            </div>
                        </div>
                        <!-- item logo-->
                        <div class="item_logo">
                            <img src="{{ asset('img/cities/' . $city->photo_path) }}"
                                alt="logo">
                        </div>
                        <!-- end item logo-->
                    </div>
                    <div class="item-description">
                        <i class="fas fa-eye"></i>
                        <h5>{{ $city->name }}</h5>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
