
@extends('layouts.admin')

@section('title', 'Създаване на Новина')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               
                <div class="card-body">
					@if(session()->has('message'))
					<div class="alert alert-success">
						{{ session()->get('message') }}
					</div>   
					@endif
                    <form id="register" method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
                        @csrf
						@if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))
						{{-- category --}}
                        <div class="form-group row">
                            <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Категория') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" type="text" data-error="Subject is required." name="category" id="category_id">
                                   @foreach($categories as $category_id => $name)
                                       <option value="{{$category_id}}" data-url="{{route('get.subcategories',$category_id)}}">{{$name}}</option>
                                   @endforeach
                               </select>
                            </div>
                        </div>                       
                        {{-- subcategory --}}
						<!--<div class="form-group row">
                            <label for="subcategory" class="col-md-4 col-form-label text-md-right">{{ __('Подкатегория') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" type="text" data-error="Subject is required." name="subcategory" id="subcategory">
                                   <option disabled="disabled" selected>
                                       Първо изберете категория 
                                   </option>
                               </select>
                            </div>
                        </div>-->
						@endif
						<div class="form-group row">
                            <label for="organization" class="col-md-4 col-form-label text-md-right">{{ __('Организация') }}
							@if(Auth::user()->hasRole('organization_member') || Auth::user()->hasRole('organization_manager'))
								<span class="required-fields">&ast;</span>
							@endif
							</label>
                            <div class="col-md-6">
                                <select id="organization_select" class="form-control" type="text" required="required" data-error="Subject is required." name="organization_id">
                                    @foreach($organizations as $organization_id => $name)                                  
                                    <option value="{{$organization_id}}" data-url="{{route('get.activities',$organization_id)}}">{{$name}}</option>                                  
                                    @endforeach 
                                </select>
								 @if ($errors->has('organization_id'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('organization_id') }}</strong>
								</span>
								@endif 
							</div>
						</div>
						 {{-- activity --}}
                        <div class="form-group row">
                            <label for="activity_id" class="col-md-4 col-form-label text-md-right">{{ __('Активност') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" type="text" data-error="Subject is required." name="activity" id="activity_id">
                                   <option disabled="disabled" selected>
                                       Първо изберете организация 
                                   </option>
                               </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Заглавие на новината') }}<span class="required-fields">&ast;</span></label>

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
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Новина') }}<span class="required-fields">&ast;</span></label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" required autofocus>{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						 <!--crop image-->
                        <div class="form-group row">
							<div class="image-editor">
								<label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Изберете заглавна снимка') }}</label>
								<div class="col-md-6">
									<input type="file" value="{{ old('photo') }}" id="photo" name="photo" class="cropit-image-input">
									<div class="cropit-preview"></div>
									<div class="image-size-label">
										<input type="hidden" name="crop" class="crop" />
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
						 {{-- date --}}
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
                        <div class="form-group row">
                            <div class="col-md-12 col-form-label required-fields-note ">
                                Полетата означени със звездичка са задължителни!
                            </div>
                        </div>
						
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="button" onclick="submitForms()" type="submit" class="btn btn-primary">
                                    {{ __('Регистрирай!') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	submitForms = function(){
    document.getElementById("register").submit();
}
</script>
@endsection
