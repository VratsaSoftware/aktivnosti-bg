
@extends('layouts.admin')

@section('title', 'Редактиране на група')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               
                <div class="card-body">
                    <form method="POST" action="{{ route('group.update', $group->group_id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- <div class="form-group row">
                            <label for="activity_id" class="col-md-4 col-form-label text-md-right">{{ __('Избери активност') }}</label>
                            
                            <div class="col-md-6">
                                <select class="form-control" type="text" required="required" data-error="Subject is required." name="activity_id">
                                    <option value="{{$group->activity_id}}" selected>{{$group->activity->name}}</option>
                                    @foreach($activities as $activity)
                                    <option value="{{$activity->activity_id}}">{{$activity->name}}</option>
                                    @endforeach
                                    @if ($errors->has('activity'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('activity') }}</strong>
                                    </span>
                                @endif 
                                </select>
                            </div>
                        </div> --}}
                        {{-- group --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Група') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$group->name}}" required autofocus>

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
                                <input id="description" type="textarea" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ $group->description }}" required autofocus>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        

                        {{-- day --}}
                        {{-- <div class="form-group row">
                            <label for="day" class="col-md-4 col-form-label text-md-right">{{ __('Ден от седмицата') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" type="text" required="required" data-error="Subject is required." name="day">
                                    <option value="понеделник">понеделник</option>
                                    <option value="вторник">вторник</option>
                                    <option value="сряда">сряда</option>
                                    <option value="четвъртък">четвъртък</option>
                                    <option value="петък">петък</option>
                                    <option value="събота">събота</option>
                                    <option value="неделя">неделя</option>
                                </select>

                                @if ($errors->has('day'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('day') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}

                        {{-- start time --}}
                       {{--  <div class="form-group row">
                            <label for="start_time" class="col-md-4 col-form-label text-md-right">{{ __('Начален час') }}</label>

                            <div class="col-md-6">
                                {{ Form::time('start_time', Carbon\Carbon::now()->format('H:i'), ['class'=>'form-control']) }}
                                @if ($errors->has('start_time'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('start_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}

                        {{-- end time --}}
                       {{--  <div class="form-group row">
                            <label for="end_time" class="col-md-4 col-form-label text-md-right">{{ __('Час на приключване') }}</label>

                            <div class="col-md-6">
                                {{ Form::time('end_time', Carbon\Carbon::now()->format('H:i'), ['class'=>'form-control']) }}
                                @if ($errors->has('end_time'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}
                        <input type="hidden" id="activity_id" name="activity_id" value="{{$group->activity_id}}">
                         
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