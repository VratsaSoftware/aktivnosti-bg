@extends('layouts.admin')

@section('title', 'Създаване на активност')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">          
                <div class="card-body">
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

                        {{-- category --}}
                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Категория') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" type="text" required="required" data-error="Subject is required." name="category_id" id="category_select">
                                   @foreach($categories as $category)
                                       <option value="{{$category->category_id}}" data-url="{{route('get.subcategories',$category->category_id)}}">{{$category->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                        </div>
                        
                        {{-- subcategory --}}
                        <div class="form-group row">
                            <label for="subcategory" class="col-md-4 col-form-label text-md-right">{{ __('Подкатегория') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" type="text" data-error="Subject is required." name="subcategory_id" id="subcategory_id">
                                   <option disabled="disabled" selected>
                                       първо избери категория 
                                   </option>
                               </select>
                            </div>
                        </div>

                        {{-- activity description --}}
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Описание на активността') }}<span class="required-fields">&ast;</span></label>
                            <div class="col-md-6">
                                <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" required autofocus></textarea>

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
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required autofocus>

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
                            <label for="min_age" class="col-md-4 col-form-label text-md-right">{{ __('Минимална възраст на участниците') }}<span class="required-fields">&ast;</span></label>
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
                            <label for="max_age" class="col-md-4 col-form-label text-md-right">{{ __('Максимална възраст на участниците') }}<span class="required-fields">&ast;</span></label>
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
                                    <div class="cropit-preview col-md-6"></div>
                                    <div class="image-size-label">
										<input type="hidden" name="crop" class="crop" />
                                        <a class="back">назад</a>
                                    </div>
                                    <input type="range" class="cropit-image-zoom-input">
                                    <button id="crop_button" form="crop_form" type="submit">Изрежи<span class="required-fields">&ast;</span></button>
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
                    
                        {{-- organization --}}
                        
                        <div class="form-group row">
                            <label for="organization" class="col-md-4 col-form-label text-md-right">{{ __('Организация') }}<span class="required-fields">&ast;</span></label>
                            <div class="col-md-6">
                                <select class="form-control" type="text" required="required" data-error="Subject is required." name="organization_id">
                                    @foreach($organizations as $organization)
                                    @if(isset($organization->approved_at))
                                    <option value="{{$organization->organization_id}}">{{$organization->name}}</option>
                                    @endif
                                    @endforeach
                                    @if ($errors->has('organization'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('organization') }}</strong>
                                    </span>
                                    @endif 
                                </select>
                            </div>
                        </div>

                        {{-- fixed start --}}
                        <div class="form-group row">
                            <label for="fixed_start" class="col-md-4 col-form-label text-md-right">{{ __('фиксиран старт') }}<span class="required-fields">&ast;</span></label>
                            <div class="col-md-6">
                                <input type="radio" name="fixed_start" value=1>да<br>
                                <input type="radio" name="fixed_start" value=0>не
                                @if ($errors->has('fixed_start'))
                                    <p><span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fixed_start') }}</strong>
                                    </span></p>
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

                        {{-- duration --}}
                        <div class="form-group row">
                            <label for="duration" class="col-md-4 col-form-label text-md-right">{{ __('Продължителност') }}</label>
                            <div class="col-md-6">
                                <input id="duration" type="text" class="form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}" name="duration" value="{{ old('duration') }}">

                                @if ($errors->has('duration'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('duration') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- end date --}}
                        <div class="form-group row">
                            <label for="end_date" class="col-md-4 col-form-label text-md-right">{{ __('Дата на приключване') }}</label>
                            <div class="col-md-6">
                                {!! Form::date('end_date', \Illuminate\Support\Carbon::now(), ['class'=>'form-control']) !!}

                                @if ($errors->has('end_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        {{-- available --}}
                        <div class="form-group row">
                            <label for="available" class="col-md-4 col-form-label text-md-right">{{ __('Наличен') }}<span class="required-fields">&ast;</span></label>
                            <div class="col-md-6">
                                <input type="radio" name="available" value=1>да<br>
                                <input type="radio" name="available" value=0>не

                            @if ($errors->has('available'))
                                <span class="invalid-feedback" role="alert">
                                    <p><strong>{{ $errors->first('available') }}</strong></p>
                                </span>
                            @endif
                            </div> 
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-10 col-form-label required-fields-note text-center">
                                Полетата означени със звездичка са задължителни!
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="button" onclick="submitForms()" type="submit" class="btn btn-primary">
                                    {{ __('Регистрирай') }}
                                </button>
                            </div>
                        </div>
                    </form>
                
                </div>
            </div>
        </div>
    </div>
</div>

@endsection