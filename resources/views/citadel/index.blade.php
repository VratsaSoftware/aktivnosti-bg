@extends('layouts.admin')

@section('title', 'Административен панел')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
       	@if(session()->has('message'))
    		<div class="alert alert-success">
       			{{ session()->get('message') }}
    		</div>
		@endif
      	@if(Auth::user()->hasAnyRole(['admin','moderator','organization_manager']))
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	Нови потребители чакащи одобрение
                	@if(Auth::user()->hasRole('organization_manager'))и заявили принадлежност към вашите организации
            		@endif
            	</div>
        		<div class="panel-body">
					<div class="table-responsive">
        				<table class="table table-striped table-bordered table-hover" id="table_users">
            				<thead>
                				<tr>
            						<th>Име</th>
									<th>Фамилия</th>
									<th>Поща</th>
									<th>Снимка</th>
									<th>Организация</th>
									<th>Статус</th>
									<th>Роля</th>
                                    <th>Дневник</th>
									<th>Управление</th>
								</tr>
            				</thead>
							<tbody>
								@isset ($users)
									@foreach($users as $user)
										@if($user->approved_by == NULL && $user->ubdated_by == NULL)
										<tr>
											<td>
												@if(!Auth::user()->hasRole('organization_manager'))
												<a class="" href="{{ route('users.show',$user->user_id)}}">{{ $user->name }}</a>
												@else
													{{ $user->name }}
												@endif
											</td>
											<td>
												@if(!Auth::user()->hasRole('organization_manager'))
												<a class="" href="{{ route('users.show',$user->user_id)}}">{{ $user->family }}</a>
												@else
													{{ $user->family }}
												@endif
											</td>
											<td>{{ $user->email }}</td>
											<td>
											@if(isset($user->photo->image_path))
												<img class='table-image' src='{{ asset('/user_files/images/profile/').'/'.$user->photo->image_path }}'>
											@else
												<span>Няма снимка</span>
											@endif
											</td>
											<td>{{ !empty($user->organizations()->first()) ? $user->organizations()->first()->name : 'Няма' }}</td>
											<td>{{ (isset($user->approved_at)) ? 'Одобрен': 'Неодобрен' }}</td>
											<td>{{ (isset($user->role->role)) ? $user->role->role : 'Няма'  }}</td>
                                            <td>
                                                @if(Auth::user()->hasAnyRole(['admin','moderator']))
                                                {!! (isset($user->approved_by)) &&  !empty($user->approved_at) ? 'Oдобрен от:<br>'.$user->approved_by.'<br>' : ''  !!}
                                                @endif
                                                {!! !empty($user->approved_at) ? 'Oдобрен на:<br>'.$user->approved_at.'<br>' : '' !!}
                                                @if(Auth::user()->hasAnyRole(['admin','moderator']))
                                                {!! (isset($user->updated_by)) ?'Променен от:<br>'.$user->updated_by.'<br>' : ''  !!}
                                                @endif
                                                {!! !empty($user->updated_at) ? 'Променен на:<br>'.$user->updated_at.'<br>' : '' !!}
                                             </td>
											<td>
												@if(!Auth::user()->hasRole('organization_manager'))
												<a class="btn btn-success btn-sm" href="{{ route('users.edit',$user->user_id)}}">Редактирай</a>
												@endif
												@if(!$user->approved_at)
													<a class="btn btn-warning btn-sm" href="{{ route('users.approve',$user->user_id)}}">Одобри</a>
												@endif
												@if(!$user->hasAnyRole(['organization_manager','admin','moderator']) && Auth::user()->hasRole('organization_manager'))
													<a class="btn btn-danger btn-sm" href="{{ route('users.kickUserFromOrganization',[$user->user_id,$user->organizations()->first()])}}" onsubmit="return ConfirmDelete('{{ 'потребител '.$user->name.' '.$user->family.' '.$user->email }}')">Премахни</a>
												@endif
											</td>
										</tr>
										@endif
									@endforeach
								@endisset
							</tbody>
        				</table>
        			</div>
        		</div>
        	</div>
        	<div class="panel panel-default">
				<div class="panel-heading">
                	Потребители с отменено одобрение @if(Auth::user()->hasRole('organization_manager')) за вашите организации @endif
            	</div>
        		<div class="panel-body">
					<div class="table-responsive">
        				<table class="table table-striped table-bordered table-hover" id="table_unapproved_users">
            				<thead>
                				<tr>
            						<th>Име</th>
									<th>Фамилия</th>
									<th>Поща</th>
									<th>Снимка</th>
									<th>Организация</th>
									<th>Статус</th>
									<th>Роля</th>
                                    <th>Дневник</th>
									<th>Управление</th>
								</tr>
            				</thead>
							<tbody>
								@isset ($users)
									@foreach($users as $user)
										@if($user->approved_by !== NULL && $user->updated_by !== NULL)
										<tr>
											<td>
												@if(!Auth::user()->hasRole('organization_manager'))
												<a class="" href="{{ route('users.show',$user->user_id)}}">{{ $user->name }}</a>
												@else
													{{ $user->name }}
												@endif
											</td>
											<td>
												@if(!Auth::user()->hasRole('organization_manager'))
												<a class="" href="{{ route('users.show',$user->user_id)}}">{{ $user->family }}</a>
												@else
													{{ $user->family }}
												@endif
											</td>
											<td>{{ $user->email }}</td>
											<td>
											@if(isset($user->photo->image_path))
												<img class='table-image' src='{{ asset('/user_files/images/profile/').'/'.$user->photo->image_path }}'>
											@else
												<span>Няма снимка</span>
											@endif
											</td>
											<td>{{ !empty($user->organizations()->first()) ? $user->organizations()->first()->name : 'Няма' }}</td>
											<td>{{ (isset($user->approved_at)) ? 'Одобрен': 'Неодобрен' }}</td>
											<td>{{ (isset($user->role->role)) ? $user->role->role : 'Няма'  }}</td>
                                            <td>
                                                @if(Auth::user()->hasAnyRole(['admin','moderator']))
                                                {!! (isset($user->approved_by)) &&  !empty($user->approved_at) ? 'Oдобрен от:<br>'.$user->approved_by.'<br>' : ''  !!}
                                                @endif
                                                {!! !empty($user->approved_at) ? 'Oдобрен на:<br>'.$user->approved_at.'<br>' : '' !!}
                                                @if(Auth::user()->hasAnyRole(['admin','moderator']))
                                                {!! (isset($user->updated_by)) ?'Променен от:<br>'.$user->updated_by.'<br>' : ''  !!}
                                                @endif
                                                {!! !empty($user->updated_at) ? 'Променен на:<br>'.$user->updated_at.'<br>' : '' !!}
                                            </td>
											<td>
												@if(!Auth::user()->hasRole('organization_manager'))
												<a class="btn btn-success btn-sm" href="{{ route('users.edit',$user->user_id)}}">Редактирай</a>
												@endif
												@if(!$user->approved_at)
													<a class="btn btn-warning btn-sm" href="{{ route('users.approve',$user->user_id)}}">Одобри Отново</a>
												@if(!$user->hasAnyRole(['organization_manager','admin','moderator']) && Auth::user()->hasRole('organization_manager'))
													<a class="btn btn-danger btn-sm" href="{{ route('users.kickUserFromOrganization',[$user->user_id,$user->organizations()->first()])}}" onsubmit="return ConfirmDelete()">Премахни</a>
												@endif
												@endif
											</td>
										</tr>
										@endif
									@endforeach
								@endisset
							</tbody>
        				</table>
        			</div>
        		</div>
        	</div>
        	@if(Auth::user()->hasRole('organization_manager'))
        	<div class="panel panel-default">
				<div class="panel-heading">
                	Aктивни потребители във вашите организации
            	</div>
        		<div class="panel-body">
					<div class="table-responsive">
        				<table class="table table-striped table-bordered table-hover" id="table_moderator_users">
            				<thead>
                				<tr>
            						<th>Име</th>
									<th>Фамилия</th>
									<th>Поща</th>
									<th>Снимка</th>
									<th>Организация</th>
									<th>Статус</th>
									<th>Роля</th>
									<th>Управление</th>
								</tr>
            				</thead>
							<tbody>
								@isset ($allUsers)
									@foreach($allUsers as $user)
										@if($user->isApproved())
										<tr>
											<td>
												@if(!Auth::user()->hasRole('organization_manager'))
												<a class="" href="{{ route('users.show',$user->user_id)}}">{{ $user->name }}</a>
												@else
													{{ $user->name }}
												@endif
											</td>
											<td>
												@if(!Auth::user()->hasRole('organization_manager'))
												<a class="" href="{{ route('users.show',$user->user_id)}}">{{ $user->family }}</a>
												@else
													{{ $user->family }}
												@endif
											</td>
											<td>{{ $user->email }}</td>
											<td>
											@if(isset($user->photo->image_path))
												<img class='table-image' src='{{ asset('/user_files/images/profile/').'/'.$user->photo->image_path }}'>
											@else
												<span>Няма снимка</span>
											@endif
											</td>
											<td>{{ !empty($user->organizations()->first()) ? $user->organizations()->first()->name : 'Няма' }}</td>
											<td>{{ (isset($user->approved_at)) ? 'Одобрен': 'Неодобрен' }}</td>
											<td>{{ (isset($user->role->role)) ? $user->role->role : 'Няма'  }}</td>
											<td>
											@if(!$user->approved_at)
													<a class="btn btn-warning btn-sm" href="{{ route('users.approve',$user->user_id)}}">Одобри</a>
											@else
											@if(!$user->hasAnyRole(['organization_manager','admin','moderator']))
												<a class="btn btn-info btn-sm" href="{{ route('users.unApprove',$user->user_id)}}">Неодобрявам</a>
											@endif
											@endif
												@if(!$user->hasAnyRole(['organization_manager','admin','moderator']))
												<a class="btn btn-danger btn-sm" href="{{ route('users.kickUserFromOrganization',[$user->user_id,$user->organizations()->first()])}}" onsubmit="return ConfirmDelete()">Премахни</a>
												@endif
											</td>
										</tr>
										@endif
									@endforeach
								@endisset
							</tbody>
        				</table>
        			</div>
        		</div>
        	</div>
        	@endif
        @endif
        <div class="panel panel-default">
    		 <div class="panel-heading">
    		 	@if(Auth::user()->hasAnyRole(['admin','moderator']))
                	Организации чакащи одобрение
                @else
                	Вашата организация
                @endif
            </div>
        	<div class="panel-body">
				<div class="table-responsive">
        			<table class="table table-striped table-bordered table-hover" id="table_organizations">
            		<thead>
                		<tr>
            				<th>Организация</th>
							<th>Поща</th>
							<th>Адрес</th>
							<th>Телефон</th>
							<th>Лого</th>
							<th>Статус</th>
							<th>Управление</th>
						</tr>
            		</thead>
					<tbody>
						@foreach($organizations as $organization)
						<tr>
							<td>{{ $organization->name }}</td>
							<td>{{ $organization->email }}</td>
							<td>{{ $organization->address }}</td>
							<td>{{ $organization->phone }}</td>
							<td>
                                {{ $organization->id }}
								@isset($purposeLogo)
									@if(isset($organization->photos->where('purpose_id',$purposeLogo)->sortByDesc('updated_at')->first()->image_path))
										<img class='table-image' src='{{ asset('/user_files/images/organization/').'/'.$organization->photos->where('purpose_id',$purposeLogo)->sortByDesc('updated_at')->first()->image_path }}'>
									@else
										<span>Няма снимка</span>
									@endif
								@endisset
							</td>
							<td>{{ (isset($organization->approved_at)) ? 'Одобрен': 'Неодобрен' }}</td>
							<td>
							<a class="btn btn-success btn-sm" href="{{ route('organizations.edit',$organization->organization_id)}}">Редактирай</a>
							@if(Auth::user()->hasAnyRole(['admin','moderator']))
								@if(!$organization->approved_at)
								<a class="btn btn-warning btn-sm" href="{{ route('organizations.approve',$organization->organization_id)}}">Одобри</a>
								@endif
							@endif
							</td>
						</tr>
						@endforeach
					</tbody>
        			</table>
        		</div>
    		</div>
    	</div><!--end panel default-->
    </div>
</div>



@endsection
