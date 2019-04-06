@extends('layouts.admin')

@section('title', 'Редактиране на организация')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('organizations.update', $organization->organization_id) }}" enctype="multipart/form-data">
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

						@foreach($organization->photos as $photo)
							@if($photo->image_path)
                        <div class="row">
							<div class="col-md-6 old-img">
								<img src="{{ asset('user_files/images/organization/'.$photo->image_path)}}" alt="{{$photo->description}}">
							</div>
						</div>
							@endif
						@endforeach
                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Снимка') }}</label>
                             <div class="col-md-6">
                                {!! Form::file('photo', array('class'=>'file', 'id'=>'photo')) !!} 
                                @if ($errors->has('photo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif  
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Редактирай!') }}
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
