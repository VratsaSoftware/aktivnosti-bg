@extends('layouts.adminEditMaster')

@section('content')

<div class='col-md-6 col-md-offset-3'>
  <h2>Add new user</h2>
<hr>
  
{!! Form::open(['action' => 'UsersController@store','files' => true]) !!}
	 @include('users.form', ['submitButtonText' => 'Add User'])
{!! Form::close() !!}
 </div>

@endsection