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
                                    Статус  {{ (isset($user->approved_at)) ? ' - Одобрен': '' }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-md-3">
                                    {{ $user->address }}
                                </td>
                                @if(Auth::user()->hasAnyRole(['admin','moderator']))
                                <td class="col-md-3">
                                    @isset($user->approved_at)
                                    <table class="table table-striped table-bordered table-hover table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Одобрен от
                                                </th>
                                                <th>
                                                    Одобрен на
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-md-3">
                                                    {{ (isset($user->approved_by)) ? $user->approved_by : '-'  }}
                                                </td>
                                                <td class="col-md-3">
                                                    {{ !empty($user->approved_at) ? $user->approved_at : '-' }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @endisset
                                    @empty($user->approved_at)
                                        Неодобрен
                                    @endempty
                                    @isset($user->updated_at)
                                    <table class="table table-striped table-bordered table-hover table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Последно променен от
                                                </th>
                                                <th>
                                                    Променен на
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-md-3">
                                                    {{ (isset($user->updated_by)) ? $user->updated_by : '-'  }}
                                                </td>
                                                <td class="col-md-3">
                                                    {{ !empty($user->updated_at) ? $user->updated_at : '-' }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @endisset
                                </td>
                                @endif
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
            <div class="col-md-12">
                <form style="display: inline-block" method="POST" action="{{ route('users.destroy',$user->user_id) }}" onsubmit="return ConfirmDelete('{{ 'потребител '.$user->name.' '.$user->family.' '.$user->email }}')">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                    <input class="btn btn-danger" type="submit" name="submit" value="Изтрий потребител">
                </form>
            </div>
            <div class="col-md-10">
    			{!! Form::model($user, ['enctype' => 'multipart/form-data', 'method' => 'PATCH','files' => true, 'action' => ['UsersController@update',$user->user_id]]) !!}
        		@include('users.form', ['submitButtonText' => 'Запази промените'])
    			{!! Form::close() !!}
   			 </hr>
			</div>
@endsection
