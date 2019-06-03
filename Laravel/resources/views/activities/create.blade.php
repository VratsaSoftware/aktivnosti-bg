@extends('layouts.admin')

@section('title', 'Създаване на активност')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">          
                <div class="card-body">

                @if($newActivityFlag === 1)
                        <div class="alert alert-success">
                            Организацията е създадена успешно! Моля продължете с последната стъпка - създаване на нова активност.
                        </div>  
                <div class="card-body">
                     <img src="{{ asset('/admin/img').'/registration_roadmap_act.png' }}" class="roadmap-image">
                </div> 
                 @endif

                    <form method="POST" action="{{ route('activities.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- activity name --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Име на активност') }}<span class="required-fields">&ast;</span></label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>
						{{-- organization --}}
                        @if($newActivityFlag !== 1)

                        <div class="form-group row">
                            <label for="organization" class="col-md-4 col-form-label text-md-right">{{ __('Организация') }}<span class="required-fields">&ast;</span></label>
                            <div class="col-md-6">
                                <select id="select" class="form-control" type="text" required="required" data-error="Subject is required." name="organization_id">
                                    @foreach($organizations as $organization)
                                    <option value="{{$organization->organization_id}}" data-amount="{{$organization->address}}"@if($organization->organization_id==old('organization_id')) selected @endif>{{$organization->name}}</option>
                                    @endforeach
                                    @if ($errors->has('organization'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('organization') }}</strong>
                                    </span>
                                    @endif 
                                </select>
                            </div>
                        </div>
                        @else
                            <input name="organization_id" type="hidden" value="{{ Auth::user()->organizations->first()->organization_id }}">
                        @endif
                        {{-- category --}}
                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Категория') }}<span class="required-fields">&ast;</span></label>
                            <div class="col-md-6">
							
                                <select class="form-control" type="text" data-error="Subject is required." name="category_id" id="category_select">
									
                                   @foreach($categories as $category_id => $name)
									
                                       <option value="{{$category_id}}" data-url="{{route('get.subcategories',$category_id)}}" @if($category_id==old('category_id')) selected @endif >{{$name}}</option>
									   
                                   @endforeach
                               </select>
							    @if ($errors->has('category_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        {{-- subcategory --}}
                        <div class="form-group row">
                            <label for="subcategory" class="col-md-4 col-form-label text-md-right">{{ __('Подкатегория') }}<span class="recommended-fields">&ast;</span></label>
                            <div class="col-md-6">
                                <select class="form-control" type="text"  name="subcategory_id" id="subcategory_id">
                                   <option disabled="disabled" selected>
                                       Първо изберете категория 
                                   </option>
                               </select>
                            </div>
                        </div>

                        {{-- activity description --}}
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Описание на активността') }}<span class="required-fields">&ast;</span></label>
                            <div class="col-md-6">
                                <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" required autofocus>{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        {{-- requirements --}}
                        <div class="form-group row">
                            <label for="requirements" class="col-md-4 col-form-label text-md-right">{{ __('Носете си') }}</label>
                            <div class="col-md-6">
                                <input id="requirements" type="text" class="form-control{{ $errors->has('requirements') ? ' is-invalid' : '' }}" name="requirements" value="{{ old('requirements') }}">

                                @if ($errors->has('requirements'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('requirements') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>
                        
                        {{-- city --}}
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Град') }}</label>
                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="Враца" required autofocus disabled>
                            </div>
                        </div>

                        {{-- address --}}
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Адрес') }}<span class="required-fields">&ast;</span></label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="address form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required autofocus>

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        {{-- activity price --}}
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Цена') }}<span class="required-fields">&ast; посочете цена, ако активността не е безплатна</span></label>

                            <div class="col-md-6">
                                {!! Form::number('price',null,['class' => 'form-control','step'=>'0.01']) !!}

                                @if ($errors->has('price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        {{-- min age --}}
						<div class="form-group row">
                            <label for="min_age" class="col-md-4 col-form-label text-md-right">{{ __('Минимална възраст на участниците') }}<span class="recommended-fields">&ast;</span></label>
                            <div class="col-md-6">
                                {!! Form::number('min_age', null, ['class'=>'form-control']) !!}

                                @if ($errors->has('min_age'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('min_age') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        {{-- max age --}}
                        <div class="form-group row">
                            <label for="max_age" class="col-md-4 col-form-label text-md-right">{{ __('Максимална възраст на участниците') }}<span class="recommended-fields">&ast;</span></label>
                            <div class="col-md-6">
                                {!! Form::number('max_age', null, ['class'=>'form-control']) !!}
                                
                                @if ($errors->has('max_age'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('max_age') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        {{-- photo --}}
                        <div class="form-group row">
                            <div class="image-editor">
                                <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Избери заглавна снимка') }}<span class="required-fields">&ast;</span></label>
                                <div class="col-md-6">
                                    <input type="file" id="photo" name="photo" class="cropit-image-input">
                                    <div class="cropit-preview"></div>
                                    <div class="image-size-label">
										<input type="hidden" name="crop" class="crop" />
                                    </div>
                                    <input type="range" class="cropit-image-zoom-input">
									<a class="back btn btn-warning btn-sm">назад</a>
                                    <button id="crop_button" class=" btn btn-warning btn-sm" form="crop_form" type="submit">Изрежи</button>
                                    @if ($errors->has('photo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- photo multiple file--}}
                        <div class="form-group row">
                            <label for="gallery" class="col-md-4 col-form-label text-md-right">{{ __('Създай галерия от снимки') }}</label>
                            <div class="col-md-6">
                                <input type="file" id="gallery" name="gallery[]" class="cropit-image-input" multiple>
                                @if ($errors->has('gallery'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('gallery') }}</strong>
                                </span>
                                @endif  
                            </div>
                        </div>    

                        {{-- start date --}}
                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Начална дата') }}<span class="required-fields">&ast;</span></label>
                            <div class="col-md-6">
                                {!! Form::date('start_date', \Illuminate\Support\Carbon::now(), ['class'=>'form-control']) !!}

                                @if ($errors->has('start_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        {{-- duration (disabled since 27.05.19)--}}

                        {{-- end date --}}
                        <div class="form-group row">
                            <label for="end_date" class="col-md-4 col-form-label text-md-right">{{ __('Дата на приключване') }}</label>
                            <div class="col-md-6">
                                {!! Form::date('end_date', '', ['class'=>'form-control']) !!}

                                @if ($errors->has('end_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        {{-- fixed start --}}
                        <hr>

                        <div class="form-group row">
                            <label for="fixed_start" class="col-md-4 col-form-label text-md-right">{{ __('Фиксиран старт') }}<span class="required-fields">&ast;</span></label>

                            <div class="col-md-6">
                                <input type="radio" name="fixed_start" value=1 checked>Да<br>
                                <input type="radio" name="fixed_start" value=0>Не

                                @if ($errors->has('fixed_start'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fixed_start') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 col-form-label required-fields-note text-left">
                                Моля отбележете "Да" ако вашата активност е с фиксирано начало, след посочената в по-горе начална дата. Пример - обучение, летен лагер.
                                Моля отбележете "Не" ако вашата активност вече е налична в момента на регистрацията или продължава целогодишно. Пример - тренировки.  
                            </div>
                        </div>

                        {{-- available --}}
                        @if($newActivityFlag !== 1)
                        <hr>
                        <div class="form-group row">
                            <label for="available" class="col-md-4 col-form-label text-md-right">{{ __('Наличен') }}<span class="required-fields">&ast;</span></label>
                            <div class="col-md-6">
                                <input type="radio" name="available" value=1 checked>да<br>
                                <input type="radio" name="available" value=0>не

                            @if ($errors->has('available'))
                                <span class="invalid-feedback" role="alert">
                                    <p><strong>{{ $errors->first('available') }}</strong></p>
                                </span>
                            @endif
                            </div> 
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 col-form-label required-fields-note text-left">
                                С полето "наличен" определяте дали дадена активност е налична в момента. Пример - при запълване на групите може да отбележите, че активноста не е налична и тя няма да се появява на началната страница. При освобождаване на места или разширяване на групите, може отново да отбележите "да".
                            </div>
                        </div>
                        <hr>
                        @else
                            <input name="available" type="hidden" value="1">
                        @endif
                        
                        
                        <div class="form-group row">
                            <div class="col-md-12 col-form-label required-fields-note text-left">
                                Полетата означени с <span class="required-fields">&ast;</span> са задължителни, а полетата означени с  <span class="recommended-fields">&ast;</span> - препоръчителни!
                            </div>
                        </div>
    
                        <div class="form-group row mb-0">
                            <div class="col-md-8 col-md-offset-2 text-center">
                            @if($newActivityFlag === 1)
                                <button id="button" onclick="submitForms()" type="submit" class="btn btn-success">
                                   {{ __('Завърши регистрацията') }}
                                    &nbsp;
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                </button>
                            @else   
                                <button id="button" onclick="submitForms()" type="submit" class="btn btn-primary">
                                    {{ __('Регистрирай') }}
                                </button>
                            @endif
                            </div>
                        </div>
                    </form>
                
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$( window ).load(function() {
		if($('.is-invalid').length == 0){
		 var sampleAmount = $('#select option:selected').data('amount');
		 $('#address').val(sampleAmount);
		 console.log(sampleAmount);
		}
		
	});
	$( '#select' ).change(function() {
		 var sampleAmount = $('#select option:selected').data('amount');
		 $('#address').val(sampleAmount);
		 console.log(sampleAmount);
		
	});
</script>

@endsection