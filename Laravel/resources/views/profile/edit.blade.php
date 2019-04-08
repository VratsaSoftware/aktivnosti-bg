@extends('layouts.admin')

@section('title', 'Редактиране на профил')

@section('content')
<div class="col-md-10">
    {!! Form::model($user, ['enctype' => 'multipart/form-data', 'method' => 'PATCH','files' => true, 'action' => ['ProfileController@update',$user->user_id]]) !!}
        @include('profile.form', ['submitButtonText' => 'Запази промените'])
    {!! Form::close() !!}
    </hr>
</div>
@endsection
