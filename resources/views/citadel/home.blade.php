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
        <div class="col-md-11">
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
                        <p> След одобрение от модератор
                            @if(Auth::user()->hasRole('organization_member'))
                                <span>&nbsp;или мениджър на организация&nbsp;</span>
                            @endif
                         ще имате достъп до другите функционалности на сайта!
                        </p>
                        @if(Auth::user()->hasRole('organization_manager'))
                            <p>Междувременно можете да добавяте нови активности, да редактирате съществуващи активности и да създавате групи, и разписания. Всяка активност е необходимо да бъде одобрена, преди да стане видима на началната страница.</p>
                             <img src="{{ asset('/admin/img').'/avail_options.png' }}" class="roadmap-image">
                        @endif
                        <p> Може да се свържете с нас на <a href="mailto:contacts@aktivnosti.bg">contacts@aktivnosti.bg</a></p>
                    @endif

                    @if(Auth::user()->isApproved() && !Auth::user()->role)
                        <p> Акаунтът ви e одобрен! Необходимо е да бъдете присъединен към организация, от модератор или администратор. Може да се свържете с нас на <a href="mailto:contacts@aktivnosti.bg">contacts@aktivnosti.bg</a>
                        </p>
                    @endif

                </div>
            </div>
        </div>
        @if(Auth::user()->hasAnyRole(['organization_manager','organization_member']))
        <div class="col-md-11">
            <div class="card">
                <div class="card-body">
                    <p>
                        Стъпки при създаване на активност:
                    </p>
                    <img src="{{ asset('/admin/img').'/activity_roadmap_common.png' }}" class="roadmap-image">
                 </div>
            </div>
        </div>
        @endif
         <div class="col-md-11">
             <button type="button" class="btn btn-warning" onclick="window.location='{{ url("/") }}'">Начална страница</button>
        </div>
    </div>
</div>

@endsection











