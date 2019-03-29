@extends('layouts.admin')

@section('title', 'Административен панел')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Потребители чакащи одобрение
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
							<th>Управление</th>
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
								<img src='{{ asset('/user_files/images/profile/').'/'.$user->photo->image_path }}' width="50" height="30">
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
							</td>
						</tr>
						@endforeach
					</tbody>
        			</table>
        		</div>
    		</div>
    		 <div class="panel-heading">
                Организации чакащи одобрение
            </div>
        	<div class="panel-body">
				<div class="table-responsive">
					@if(session()->has('message'))
    				<div class="alert alert-success">
       			 		{{ session()->get('message') }}
    				</div>   
					@endif
        			<table class="table table-striped table-bordered table-hover" id="table_organizations">
            		<thead>
                		<tr>
            				<th>Организация</th>
							<th>Информация</th>
							<th>Поща</th>
							<th>Адрес</th>
							<th>Телефон</th>
							<th>Лого</th>
							<th>Одобрена</th>
							<th>Управление</th>
						</tr>
            		</thead>
					<tbody>
						@foreach($organizations as $organization)
						<tr>
							<td>{{ $organization->name }}</td>
							<td>{{ $organization->description }}</td>
							<td>{{ $organization->email }}</td>
							<td>{{ $organization->address }}</td>
							<td>{{ $organization->phone }}</td>
							<td>
						

							@if(isset($organization->photos->where('purpose_id',$purpose_id)->first()->image_path))
								<img src='{{ asset('/user_files/images/organizations/').'/'.$organization->photos->where('purpose_id',$purpose_id)->first()->image_path }}' width="50" height="30">
							@else
								<span>Няма снимка</span>
							@endif
							</td>
							<td>{{ (isset($organization->approved_at)) ? 'Одобрен': 'Неодобрен' }}</td>
							<td>
							<a class="btn btn-success btn-sm" href="{{ route('organizations.edit',$organization->organization_id)}}">Редактирай</a>
							@if(!$organization->approved_at)
							<a class="btn btn-warning btn-sm" href="{{ route('organizations.approve',$organization->organization_id)}}">Одобри</a>
							@endif
							</td>
						</tr>
						@endforeach
					</tbody>
        			</table>
        		</div>
    		</div>
    	</div>
    </div>
</div>



@endsection