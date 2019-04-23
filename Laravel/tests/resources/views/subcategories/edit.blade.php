
@extends('layouts.admin')

@section('title', 'Редактиране на подкатегория')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               
                <div class="card-body">
                    <form method="POST" action="{{ route('subcategory.update', $subcategory->subcategory_id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        {{-- subcategory --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Подкатегория') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$subcategory->name}}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{-- description --}}
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Описание') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="textarea" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ $subcategory->description }}" required autofocus>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Избери категория') }}</label>
                            
                            <div class="col-md-6">
                                <select class="form-control" type="text" required="required" data-error="Subject is required." name="category_id">
                                    <option value="{{$subcategory->category_id}}" selected>{{$subcategory->category->name}}</option>
                                    @foreach($categories as $category)
                                    @if($subcategory->category_id !== $category->category_id);
                                    <option value="{{$category->category_id}}">{{$category->name}}</option>
                                    @endif
                                    @endforeach
                                    @if ($errors->has('category'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif 
                                </select>
                            </div>
                        </div>
                                                 
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Редактирай') }}
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