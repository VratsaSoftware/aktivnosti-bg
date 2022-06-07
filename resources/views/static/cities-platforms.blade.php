@extends('layouts.master')

@section('title', 'Избери твоя град')

@section('content')
    <!-- main container -->
    <div class="main-container portfolio-inner clearfix text-center">
        <ul style="list-style-type: none">
            @foreach($cities as $city)
                <li style="font-size: 17px">
                    <a href="{{ $city->platformUrl }}">{{ $city->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
