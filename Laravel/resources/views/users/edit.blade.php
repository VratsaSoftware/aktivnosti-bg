@extends('layouts.adminMaster')

@section('content')
<div class='col-md-6 col-md-offset-3'>
  <h3>Edit User</h3>

<hr>
  
  {!! Form::model($user, ['method' => 'PATCH','files' => true, 'action' => ['UsersController@update',$user->user_id]]) !!}
   @include('users.form', ['submitButtonText' => 'Save Changes'])
  {!! Form::close() !!}
 </div>

@endsection