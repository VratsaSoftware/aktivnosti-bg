@extends('layouts.admin')

@section('pageheader')
Профил
@endsection

@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>   
@endif

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @isset ($message)
                    <div class="alert alert-warning">
                        {{ $message }}
                    </div>   
                    @endisset

                    <p>Влязохте в профила си успешно!</p>
                    
                    @if(!Auth::user()->isApproved())
                        <p> След одобрение от модератор ще имате достъп до другите функционалности на сайта! </p>
                    @endif

                    @if(Auth::user()->isApproved() && !Auth::user()->role)
                        <p> Акаунтът ви e одобрен! Необходимо е да бъдете присъединен към организация, от модератор или администратор. Моля пишете ни на team@aktivosti.bg за допълнителна информация!
                        </p>
                    @endif

                    <button type="button" class="btn btn-warning" onclick="window.location='{{ url("/") }}'">Начална страница</button>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection











