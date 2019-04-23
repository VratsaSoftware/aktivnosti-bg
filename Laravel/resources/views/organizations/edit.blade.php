@extends('layouts.admin')

@section('title', 'Редактиране на организация')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
					<!--organization logo-->
					@foreach($logo as $photo)	
					<div class="row">
					@if($logo)
						
						<div class="col-md-6 old-img">
							<img src="{{ asset('user_files/images/organization/'.$photo->image_path)}}" alt="{{$photo->description}}">
						</div>
					</div>
					@endif
					@endforeach
					<!--end organization logo-->
                    <form id="register" method="POST" action="{{ route('organizations.update', $organization->organization_id) }}" enctype="multipart/form-data">
                        @csrf
						@method('PUT')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Име на организацията') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $organization->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
	
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Описание') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ $organization->description }}" required autofocus>{{ $organization->description }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
												<div class="form-group row">
                            <label for="website" class="col-md-4 col-form-label text-md-right">{{ __('Сайт на организацията') }}</label>

                            <div class="col-md-6">
                                <input id="website" type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" name="website" value="{{ $organization->website }}">

                                @if ($errors->has('website'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Електронна поща') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $organization->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Адрес') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $organization->address }}" required autofocus>

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

						<div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Телефон') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $organization->phone }}" required autofocus>

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

                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if(Auth::user()->hasAnyRole(['admin','moderator']))
                        <div class='form-group row'>
                            {!! Form::label('approved', 'Статус',['class' => 'col-md-4 col-form-label text-md-right']) !!}
                            <div class="col-md-6">
                                {!! Form::select('approved',$approvals,null,['class' => 'form-control']) !!}
                            </div>
                        </div>
                        @endif								
                        <!--crop image-->
                        <div class="form-group row">
							<div class="image-editor">
								<label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Изберете нова заглавна снимка') }}</label>
								<div class="col-md-6">
									<input type="file" id="photo" name="photo" class="cropit-image-input">
									<div class="cropit-preview"></div>
									<div class="image-size-label">
									<input type="hidden" name="crop" class="crop" />	
										<a class="btn btn-warning btn-sm back">назад</a>
									</div>
									<input type="range" class="cropit-image-zoom-input">
									<button  id="crop_button" class="btn btn-warning btn-sm" form="crop_form" type="submit">Изрежи</button>
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
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="button" onclick="submitForms()" type="submit" class="btn btn-primary">
                                    {{ __('Редактирай!') }}
                                </button>
                            </div>
                        </div>
							
                    </form>
					 <div class="row">
						@foreach($gallery as $photo)	
				
							<div class="col-md-3 old-img">	
						
						<form style="display: inline-block" method="POST" action="{{ 	route('organizations.destroyGallery',$photo->photo_id) }}" >
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<input class="btn btn-danger btn-sm" type="submit" name="submit" value="Изтрий">
						</form>
								<img src="{{ asset('user_files/images/organization/gallery/'.$photo->image_path)}}" alt="{{$photo->description}}">
							</div>
							
						@endforeach
					</div>
					
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
