<div class='form-group'>

 		{!! Form::label('name', 'Name:') !!}
 		{!! Form::text('name', null, ['class' => 'form-control']) !!}
	</div>
	@if ($errors->has('name'))
    <div class="alert alert-danger">{{ $errors->first('name') }}</div>
	@endif

	<div class='form-group'>
 		{!! Form::label('family','Family') !!}
 		{!! Form::text('family', null, ['class' => 'form-control']) !!}
	</div>
	@if ($errors->has('family'))
    <div class="alert alert-danger">{{ $errors->first('family') }}</div>
	@endif
	
	<div class='form-group'>
 		{!! Form::label('email','Email') !!}
 		{!! Form::text('email', null, ['class' => 'form-control']) !!}
	</div>
	@if ($errors->has('email'))
    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
	@endif

	<div class='form-group'>
 		{!! Form::label('address','Address') !!}
 		{!! Form::text('address', null, ['class' => 'form-control']) !!}
	</div>
	@if ($errors->has('address'))
    <div class="alert alert-danger">{{ $errors->first('address') }}</div>
	@endif

	<div class='form-group'>
 		{!! Form::label('phone','Phone') !!}
 		{!! Form::text('phone', null, ['class' => 'form-control']) !!}
	</div>
	@if ($errors->has('phone'))
	<div class="alert alert-danger">{{ $errors->first('phone') }}</div>
	@endif

    <div class="alert alert-danger">{{ $errors->first('photo') }}</diphoto<div class='form-group'>
 		{!! Form::label('photo','Photo') !!}
 		{!! Form::text('photo', null, ['class' => 'form-control']) !!}
	</div>
	@if ($errors->has('photo'))
	<div class="alert alert-danger">{{ $errors->first('photo') }}</div>
	@endif

	<div class='form-group'>
 		{!! Form::label('approved', 'Approved') !!}
		{!! Form::select('approved',$approvals,null,['class' => 'form-control']) !!}
	</div>

	<div class='form-group'>
 		{!! Form::label('role', 'Role') !!}
		{!! Form::select('role',$roles,null,['class' => 'form-control']) !!}
	</div>

<div class='form-group'>
 {!! Form::submit($submitButtonText, ['class' => 'btn btn-lg btn-success form-control']) !!}
</div>
<div>
	<a class="btn btn-lg btn-primary form-control" href="{{ url()->previous() }}">Back</a>
</div>