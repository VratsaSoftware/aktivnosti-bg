@extends('layouts.admin')

@section('title', 'Потребител')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Профил на потребител&nbsp;&nbsp;{{ $user->name }} &nbsp;{{ $user->family }} &nbsp;{{ $user->email }}
            </div>
            <div class="panel-body">
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
                    <div>
                        <a class="btn btn-sm btn-warning" href="{{ url()->previous() }}">
                            Обратно
                        </a>
                        <a class="btn btn-danger btn-sm" href="{{ route('users.edit',$user->user_id)}}">Редактирай</a>
                        @if(!$user->approved_at)
                            <a class="btn btn-success btn-sm" href="{{ route('users.approve',$user->user_id)}}">Одобри</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
