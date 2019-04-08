@extends('layouts.admin')

@section('pageheader')
Администриране
@endsection

@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>   
@endif

@section('content')



@endsection