
@extends('layouts.admin')

@section('title', 'Редактиране на разписание')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               
                <div class="card-body">
                    <form method="POST" action="{{ route('schedule.update', $schedule->schedule_id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        {{-- day --}}
                        <div class="form-group row">
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
                            </div>
                        </div>

                        {{-- start time --}}
                        <div class="form-group row">
                            <label for="start_time" class="col-md-4 col-form-label text-md-right">{{ __('Начален час') }}</label>

                            <div class="col-md-6">
                                {{ Form::time('start_time', Carbon\Carbon::now()->format('H:i'), ['class'=>'form-control']) }}
                            </div>
                        </div>

                        {{-- end time --}}
                        <div class="form-group row">
                            <label for="end_time" class="col-md-4 col-form-label text-md-right">{{ __('Час на приключване') }}</label>

                            <div class="col-md-6">
                                {{ Form::time('end_time', Carbon\Carbon::now()->format('H:i'), ['class'=>'form-control']) }}
                            </div>
                        </div>
                        <input type="hidden" id="group_id" name="group_id" value="{{$schedule->group_id}}">
                         
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