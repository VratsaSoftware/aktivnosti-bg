@extends('layouts.admin')

@section('title', 'Редактиране на потребител')

@section('content')
            <div class="col-md-10">
                <div>
                @if(isset($user->photo->image_path))
                    <p>Снимка</p>
                    <img src='{{ asset('/user_files/images/profile/').'/'.$user->photo->image_path }}' class='user-image'>
                @else
                    <span>Няма снимка</span>
                @endif
                </div>
                <div class="table-responsive">
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th>
                                    Име
                                </th>
                                <th>
                                    Фамилия
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-md-3">
                                    {{ $user->name }}
                                </td>
                                <td class="col-md-3">
                                    {{ $user->family }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th>
                                    Поща
                                </th>
                                <th>
                                    Телефон
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-md-3">
                                    {{ $user->email }}
                                </td>
                                <td class="col-md-3">
                                    {{ $user->phone }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th>
                                    Адрес
                                </th>
                                <th>
                                    Статус
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-md-3">
                                    {{ $user->address }}
                                </td>
                                <td class="col-md-3">
                                    {{ (isset($user->approved_at)) ? 'Одобрен': 'Неодобрен' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th>
                                    Роля
                                </th>
                                <th>
                                    Организация
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-md-3">
                                    {{ (isset($user->role->role)) ? $user->role->role : 'Няма'  }}
                                </td>
                                <td class="col-md-3">
                                    {{ !empty($user->organizations()->first()) ? $user->organizations()->first()->name : 'Няма' }}
                                </td>

                            </tr>
                        </tbody>
                    </table>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Допълнителна информация
                        </div>
                        <div class="panel-body">
                            {{ $user->description }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
    			{!! Form::model($user, ['enctype' => 'multipart/form-data', 'method' => 'PATCH','files' => true, 'action' => ['UsersController@update',$user->user_id]]) !!}
        		@include('users.form', ['submitButtonText' => 'Запази промените'])
    			{!! Form::close() !!}
   			 </hr>
			</div>
@endsection
