	<div class='form-group'>
 		{!! Form::label('name', 'Име') !!}
 		<span class="required-fields">&ast;</span></label>
 		{!! Form::text('name', null, ['class' => 'form-control']) !!}
	</div>
	@if ($errors->has('name'))
    <div class="alert alert-danger">{{ $errors->first('name') }}</div>
	@endif

	<div class='form-group'>
 		{!! Form::label('family','Фамилия') !!}
 		<span class="required-fields">&ast;</span></label>
 		{!! Form::text('family', null, ['class' => 'form-control']) !!}
	</div>
	@if ($errors->has('family'))
    <div class="alert alert-danger">{{ $errors->first('family') }}</div>
	@endif
	
	<div class='form-group'>
 		{!! Form::label('email','Поща') !!}
 		<span class="required-fields">&ast;</span></label>
 		{!! Form::text('email', null, ['class' => 'form-control']) !!}
	</div>
	@if ($errors->has('email'))
    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
	@endif

	<div class='form-group'>
 		{!! Form::label('address','Адрес') !!}
 		{!! Form::text('address', null, ['class' => 'form-control']) !!}
	</div>
	@if ($errors->has('address'))
    <div class="alert alert-danger">{{ $errors->first('address') }}</div>
	@endif

	<div class='form-group'>
 		{!! Form::label('phone','Телефон') !!}
 		{!! Form::text('phone', null, ['class' => 'form-control']) !!}
	</div>
	@if ($errors->has('phone'))
	<div class="alert alert-danger">{{ $errors->first('phone') }}</div>
	@endif

	<div class='form-group'>
		<label>Снимка на профила:</label>
		<span>
		 		<img src="{{ isset($user->photo->image_path) ? asset('/user_files/images/profile/').'/'.($user->photo->image_path) : asset('/user_files/images/profile/').'/logo.png' }}" class="user-image img-responsive">
		</span>
	</div>

    <div class='form-group'>
 		{!! Form::label('photo','Промяна на снимката') !!}
 		{!! Form::file('photo', array('class'=>'file', 'id'=>'photo')) !!} 		
	</div>
	@if ($errors->has('photo'))
	<div class="alert alert-danger">{{ $errors->first('photo') }}</div>
	@endif

	<div class='form-group'>
 		{!! Form::label('description','Допълнителна информация') !!}
 		{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none']) !!}
	</div>
	@if ($errors->has('description'))
    <div class="alert alert-danger">{{ $errors->first('description') }}</div>
	@endif

	                        <div class="form-group row">
                            <div class="col-md-10 col-form-label required-fields-note text-center">
                                Полетата означени със звездичка (<span class="required-fields">&ast;</span>) са задължителни!
                            </div>
                        </div>

<div class='form-group'>
 {!! Form::submit($submitButtonText, ['class' => 'btn btn-warning']) !!}
</div>
<div>
	<a class="btn btn-default" href="{{ url()->previous() }}">Обратно</a>
</div>

