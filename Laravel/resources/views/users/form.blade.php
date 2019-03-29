	<div class='form-group'>
 		{!! Form::label('name', 'Име') !!}
 		{!! Form::text('name', null, ['class' => 'form-control']) !!}
	</div>
	@if ($errors->has('name'))
    <div class="alert alert-danger">{{ $errors->first('name') }}</div>
	@endif

	<div class='form-group'>
 		{!! Form::label('family','Фамилия') !!}
 		{!! Form::text('family', null, ['class' => 'form-control']) !!}
	</div>
	@if ($errors->has('family'))
    <div class="alert alert-danger">{{ $errors->first('family') }}</div>
	@endif
	
	<div class='form-group'>
 		{!! Form::label('email','Поща') !!}
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
		 		<img src="{{ isset($user->photo->image_path) ? asset('/user_files/images/profile/').'/'.($user->photo->image_path) : asset('/user_files/images/profile/').'/logo.png' }}" class="user-image img-responsive"
                        width="100" height="50">
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

	<div class='form-group'>
 		{!! Form::label('approved', 'Статус') !!}
		{!! Form::select('approved',$approvals,null,['class' => 'form-control']) !!}
	</div>

	<div class='form-group'>
 		{!! Form::label('role', 'Роля') !!}
		{!! Form::select('role',$roles,null,['class' => 'form-control']) !!}
	</div>

	@if (Auth::user()->hasRole('admin'))

		<div class="form-group">
			{!! Form::label('organization', 'Организация') !!}
    	    {!! Form::select('organization',$organizations,['class' => 'form-control']) !!}         
    	    @if ($errors->has('organization'))
    	        <div class="alert alert-danger">{{ $errors->first('organization') }}</div>
    	    @endif
    	</div>

	
		@isset ($categories)
			<div class='form-group' id='moderator_categories'>
				<div>
					<label>Категории (Модератор)</label>
				</div>	
			@foreach ($categories as $category_id => $name)
				<span style="display: inline-block; padding-right: 0.5%;">
					{{ Form::label($name) }}
					{{ Form::checkbox( 'categories[]',$category_id, (in_array($category_id, $userCategories) ? true: false)) }}
				</span>
			@endforeach    
			</div>
		@endisset
	@endif

<div class='form-group'>
 {!! Form::submit($submitButtonText, ['class' => 'btn btn-warning']) !!}
</div>
<div>
	<a class="btn btn-default" href="{{ url()->previous() }}">Обратно</a>
</div>

