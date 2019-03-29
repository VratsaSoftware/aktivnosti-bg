@extends('layouts.admin')

@section('title', 'Редактиране на потребител')

@section('content')
<div class="col-md-10">
    {!! Form::model($user, ['enctype' => 'multipart/form-data', 'method' => 'PATCH','files' => true, 'action' => ['UsersController@update',$user->user_id]]) !!}
        @include('users.form', ['submitButtonText' => 'Save Changes'])
    {!! Form::close() !!}
    </hr>
</div>
@endsection
