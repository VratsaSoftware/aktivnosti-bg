@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Профил</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>   
                    @endif

                    <p>Влязохте в профила си успешно!</p>
                    <p>След одобрение от модератор ще имате достъп до другите функционалности на сайта!</p>
                    <p> Може да се свържете с нас на <a href="mailto:contacts@aktivnosti.bg">contacts@aktivnosti.bg</a></p>
                    <button type="button" class="btn btn-primary" onclick="window.location='{{ url("/") }}'">Начална страница</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
