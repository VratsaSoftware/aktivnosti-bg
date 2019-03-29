@extends('layouts.admin')

@section('title', 'Администриране на потребители')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Всички потребители
            </div>
        <div class="panel-body">
	<div class="table-responsive">
		@if(session()->has('message'))
    		<div class="alert alert-success">
       			 {{ session()->get('message') }}
    		</div>   
		@endif
        <table class="table table-striped table-bordered table-hover" id="table_users">
            <thead>
                <tr>
            		<th>Име</th>
					<th>Фамилия</th>
					<th>Поща</th>
					<th>Адрес</th>
					<th>Телефон</th>
					<th>Снимка</th>
					<th>Одобрен</th>
					<th>Роля</th>
					<th colspan=2>Управление</th>
				</tr>
            </thead>
			<tbody>
				@foreach($users as $user)
				<tr>
					<td>{{ $user->name }}</td>
					<td>{{ $user->family }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->address }}</td>
					<td>{{ $user->phone }}</td>
					<td>
					@if(isset($user->photo->image_path))
						<img src='{{ asset('/user_files/images/profile/').'/'.$user->photo->image_path }}'
						width="50" height="30">
					@else
						<span>Няма снимка</span>
					@endif
					</td>
					<td>{{ (isset($user->approved_at)) ? 'Одобрен': 'Неодобрен' }}</td>
					<td>{{ (isset($user->role->role)) ? $user->role->role : 'Няма'  }}</td>
					<td>
					<a class="btn btn-success btn-sm" href="{{ route('users.edit',$user->user_id)}}">Редактирай</a>
					@if(!$user->approved_at)
					<a class="btn btn-warning btn-sm" href="{{ route('users.approve',$user->user_id)}}">Одобри</a>
					@endif
					<form style="display: inline-block" method="POST" action="{{ route('users.destroy',$user->user_id) }}">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<input class="btn btn-danger btn-sm" type="submit" name="submit" value="Изтрий">
					</form>
					</td>
				</tr>
				@endforeach
			</tbody>
        </table>
        <div>
			<a class="btn btn-sm btn-warning" href="{{ url()->previous() }}">Обратно</a>
		</div>
    </div>
    </div>
    </div>
    <!--End Advanced Tables -->
    </div>
</div>



@endsection