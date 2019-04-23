
@extends('layouts.admin')

@section('title', 'Създаване на организация')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               
                <div class="card-body">
                    <form method="POST" action="{{ route('organizations.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Име на организацията') }}<span class="required-fields">&ast;</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Описание') }}<span class="required-fields">&ast;</span></label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" required autofocus></textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Електронна поща') }}<span class="required-fields">&ast;</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
						<div class="form-group row">
                            <label for="website" class="col-md-4 col-form-label text-md-right">{{ __('Сайт на организацията') }}</label>

                            <div class="col-md-6">
                                <input id="website" type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" name="website" value="{{ old('website') }}">

                                @if ($errors->has('website'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
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

						<div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Телефон') }}<span class="required-fields">&ast;</span></label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Град') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="Враца" required autofocus disabled>

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						 <!--crop image-->
                        <div class="form-group row">
							<div class="image-editor">
								<label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Изберете заглавна снимка') }}</label>
								<div class="col-md-6">
									<input type="file" id="photo" name="photo" class="cropit-image-input">
									<div class="cropit-preview"></div>
									<div class="image-size-label">
										<input type="hidden"  name="image-data" class="hidden-image-data" />
										<a class="btn btn-warning btn-sm back">назад</a>
									</div>
									<input type="range" class="cropit-image-zoom-input">
									<button id="crop_button" class="btn btn-warning btn-sm" form="crop_form" type="submit">Изрежи</button>
									@if ($errors->has('photo'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('photo') }}</strong>
									</span>
									@endif  
								</div>
							</div>
						</div>
						<!--end crop image-->
						<!--gallery form-group -->										
						<div class="form-group row">
							<label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Създай галерия от снимки') }}</label>
							<div class="col-md-6">
								<input type="file" id="gallery" name="gallery[]" class="cropit-image-input" multiple>
								@if ($errors->has('gallery'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('gallery') }}</strong>
								</span>
								@endif  
							</div>
						</div>
						<!--end gallery form-group -->
                        <div class="form-group row">
                            <div class="col-md-12 col-form-label required-fields-note ">
                                Полетата означени със звездичка са задължителни!
                            </div>
                        </div>
						
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Регистрирай!') }}
                                </button>
                            </div>
                        </div>
                    </form>
					<!--crop image-->
					<form id="crop_form" action="#">
						<input type="hidden" name="image-data" class="hidden-image-data" />	
					</form>
					<!--crop image-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection