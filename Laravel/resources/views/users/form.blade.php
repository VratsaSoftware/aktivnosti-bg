	<div class='form-group'>
 		{!! Form::label('approved', 'Статус') !!}
		{!! Form::select('approved',$approvals,null,['class' => 'form-control']) !!}
	</div>

	<div class='form-group'>
 		{!! Form::label('role', 'Роля') !!}
		{!! Form::select('role',$roles,null,['class' => 'form-control']) !!}
		@if ($errors->has('role'))
    	    <div class="alert alert-danger">{{ $errors->first('role') }}</div>
    	@endif
	</div>

	@if (Auth::user()->hasAnyRole(['admin','moderator']))

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

