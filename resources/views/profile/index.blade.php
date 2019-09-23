@extends('layouts.admin')

@section('title', 'Потребител')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Профил
            </div>
            <div class="panel-body">
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
                    @isset($user->updated_at)
                    <table class="table table-striped table-bordered table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                @if(Auth::user()->hasAnyRole(['admin','moderator']))
                                <th>
                                    Последно променен от
                                </th>
                                @endif
                                <th>
                                    Променен на
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @if(Auth::user()->hasAnyRole(['admin','moderator']))
                                <td class="col-md-3">
                                    {{ (isset($user->updated_by)) ? $user->updated_by : '-'  }}
                                </td>
                                @endif
                                <td class="col-md-3">
                                    {{ !empty($user->updated_at) ? $user->updated_at : '-' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endisset
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
                    @isset($user->approved_by)
                    <table class="table table-striped table-bordered table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                @if(Auth::user()->hasAnyRole(['admin','moderator']))
                                <th>
                                    Одобрен от
                                </th>
                                @endif
                                <th>
                                    Одобрен на
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @if(Auth::user()->hasAnyRole(['admin','moderator']))
                                <td class="col-md-3">
                                    {{ (isset($user->approved_by)) ? $user->approved_by : '-'  }}
                                </td>
                                @endif
                                <td class="col-md-3">
                                    {{ !empty($user->approved_at) ? $user->approved_at : '-' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endisset
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            За мен
                        </div>
                        <div class="panel-body">
                            {{ $user->description }}
                        </div>
                    </div>
                    <div>
                        <a class="btn btn-sm btn-warning" href="{{ url()->previous() }}">
                            Обратно
                        </a>
                        <a class="btn btn-danger btn-sm" href="{{ route('profile.edit',Auth::user()->user_id)}}">
                            <i class="fa fa-edit "></i>
                            Редактирай
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
