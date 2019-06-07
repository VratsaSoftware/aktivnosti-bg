@extends('layouts.admin')

@section('title', 'Радактиране на активност')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">      
                <div class="card-body">
				@foreach ($activity->photos as $photo)
					<div class="row">
					
						<div class="col-md-6 old-img">
							
							@if ($photo->purpose->description == 'mine')
							<img src="{{ asset('user_files/images/activity/' . $photo->image_path) }}" alt="{{$photo->alt}}" class="img-responsive" />
							@endif
										   
						</div>
					
					</div>
					@endforeach
                    <form id="register" method="POST" action="{{ route('activities.update', $activity->activity_id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- activity name --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Име на активност') }}<span class="required-fields">&ast;</span></label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $activity->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        {{-- category --}}
                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Категория') }}<span class="required-fields">&ast;</span></label>
                            <div class="col-md-6">
                                <select class="form-control" type="text" required="required" data-error="Subject is required." name="category_id" id="category_select">
                                    @if(isset($activity->category->name))
                                    <option value="" data-url="" disabled>Изберете категория
                                    </option>
                                    @endif
                                    @foreach($categories as $category_id => $category_name)
                                        <option value="{{$category_id}}" data-url="{{route('get.subcategories',[$category_id,$activity->subcategory_id])}}">{{$category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        {{-- subcategory --}}
                        <div class="form-group row">
                            <label for="subcategory" class="col-md-4 col-form-label text-md-right">{{ __('Подкатегория') }}<span class="recommended-fields">&ast;</span></label>
                            <div class="col-md-6">
                                <select class="form-control" type="text" data-error="Subject is required." name="subcategory_id" id="subcategory_id">
                                        <option disabled="disabled">
                                            Първо изберете категория 
                                        </option>
                                </select>
                            </div>
                        </div>

                        {{-- activity description --}}
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Описание на активността') }}<span class="required-fields">&ast;</span></label>
                            <div class="col-md-6">
                                <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" required autofocus>{{$activity->description}}</textarea>

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
                                <input id="requirements" type="text" class="form-control{{ $errors->has('requirements') ? ' is-invalid' : '' }}" name="requirements" value="{{ $activity->requirements }}">

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
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $activity->address }}" required autofocus>

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        {{-- activity price --}}
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Цена') }}</label>

                            <div class="col-md-6">
                                {!! Form::number('price', $activity->price, ['class' => 'form-control','step'=>'0.01']) !!}

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
                                {!! Form::number('min_age', $activity->min_age, ['class'=>'form-control']) !!}

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
                                {!! Form::number('max_age', $activity->max_age, ['class'=>'form-control']) !!}
        
                                @if ($errors->has('max_age'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('max_age') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        {{-- photo --}}
                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Снимка') }}</label>
                            <div class="col-md-6">
                                <div class="image-editor">
                                <input type="file" id="photo" name="photo" class="cropit-image-input">
                                    <div class="cropit-preview col-md-6"></div>
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

                        {{-- photo multaple file--}}
                        <div class="form-group row">
                            <label for="gallery" class="col-md-4 col-form-label text-md-right">{{ __('Галерия') }}</label>

                            <div class="col-md-6">
                                <input type="file" id="gallery" name="gallery[]" multiple>
                                @if ($errors->has('gallery.*'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gallery.*') }}</strong>
                                    </span>
                                @endif 

                            </div>
                        </div>

                        {{-- organization --}}
                        
                        <div class="form-group row">
                            <label for="organization" class="col-md-4 col-form-label text-md-right">{{ __('Организация') }}<span class="required-fields">&ast;</span></label>
                            <div class="col-md-6">
                                <select class="form-control" type="text" required="required" data-error="Subject is required." name="organization_id">
									if(@isset($activity->organization->name))
                                    @php($organization_name = $activity->organization->name)
									
										@foreach($organizations as $organization)
											@if(isset($organization->approved_at))
												
													@if($organization->name === $organization_name)
					
										<option value="{{$organization->organization_id}}" selected>{{$organization->name}}</option>
													@else
										<option value="{{$organization->organization_id}}">{{$organization->name}}</option>
													@endif
												
											@endif
										@endforeach
									@else										
										@foreach($organizations as $organization)
											@if(isset($organization->approved_at))						
										<option value="{{$organization->organization_id}}">{{$organization->name}}</option>
																						
											@endif
										@endforeach
									@endif
                                    @if ($errors->has('organization'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('organization') }}</strong>
                                    </span>
                                    @endif 
                                </select>
                            </div>
                        </div>


                        {{-- start date --}}
                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Начална дата') }}<span class="required-fields">&ast;</span></label>

                            <div class="col-md-6">
                                {!! Form::date('start_date', $activity->start_date, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        {{-- duration (disabled since 27.05.19) --}}

                        {{-- end date --}}
                        <div class="form-group row">
                            <label for="end_date" class="col-md-4 col-form-label text-md-right">{{ __('Дата на приключване') }}</label>

                            <div class="col-md-6">
                                {!! Form::date('end_date', $activity->end_date, ['class'=>'form-control']) !!}

                                @if ($errors->has('end_date'))
                                    <span class="in-feedback" role="alert">
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
                                @if($activity->fixed_start == 1)
                                <input type="radio" name="fixed_start" value=1 checked>Да<br>
                                <input type="radio" name="fixed_start" value=0>Не
                                @else
                                <input type="radio" name="fixed_start" value=1>Да<br>
                                <input type="radio" name="fixed_start" value=0 checked>Не
                                @endif

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
                        <hr>

                        <div class="form-group row">
                            <label for="available" class="col-md-4 col-form-label text-md-right">{{ __('Наличен') }}<span class="required-fields">&ast;</span></label>

                            <div class="col-md-6">
                                @if($activity->available == 1)
                                <input type="radio" name="available" value=1 checked>да<br>
                                <input type="radio" name="available" value=0>не
                                @else
                                <input type="radio" name="available" value=1>да<br>
                                <input type="radio" name="available" value=0 checked>не
                                @endif 
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 col-form-label required-fields-note text-left">
                                С полето "наличен" определяте дали дадена активност е налична в момента. Пример - при запълване на групите може да отбележите, че активноста не е налична и тя няма да се появява на началната страница. При освобождаване на места или разширяване на групите, може отново да отбележите "да".
                            </div>
                        </div>

                        <hr>
                        
                        <div class="form-group row">
                            <div class="col-md-12 col-form-label required-fields-note text-left">
                                Полетата означени с <span class="required-fields">&ast;</span> са задължителни, а полетата означени с  <span class="recommended-fields">&ast;</span> - препоръчителни!
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="button" onclick="submitForms()" type="submit" class="btn btn-primary">
                                    {{ __('Запази промените') }}
                                </button>
                            </div>
                        </div>
					
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a class="btn btn-warning" href="{{ url()->previous() }}">
                                    Обратно
                                </a>
                            </div>
                        </div>
                    </form>
					<div class="row">
						@foreach($gallery as $photo)					
						<div class="col-md-3 old-img">							
							<form style="display: inline-block" method="POST" action="{{ 	route('activities.destroyGallery',$photo->photo_id) }}" >
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<input class="btn btn-danger btn-sm" type="submit" name="submit" value="Изтрий">
							</form>
							<img src="{{ asset('user_files/images/activity/gallery/'.$photo->image_path)}}" alt="{{$photo->description}}">
						</div>							
						@endforeach
					</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection