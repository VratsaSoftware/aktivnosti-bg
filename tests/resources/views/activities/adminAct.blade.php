@extends('layouts.admin')

@section('title', 'Администриране на активности')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Всички активности
				<a href="{{ route('activities.create')}}">Създай нова активност</a>
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
			            		<th>Активност</th>
								<th>Описание</th>
								<th>Минимална възраст</th>
								<th>Максимална възраст</th>
								<th>Цена</th>
								<th>Дата на започване</th>
								<th>Дата на приключване</th>
								<th>Продължителност</th>
								<th>Наличен</th>
								<th>Носете си</th>
								<th>Fixed start</th>
								<th>Адрес</th>
								<th>Организация</th>
								<th>Категория</th>
								<th>Подкатегория</th>
								<th>Снимка</th>
								<th>Статус</th>
								<th>Групи</th>
								<th>Преглед</th>
								<th>Редактирай</th>
								<th>Изтрии</th>
							</tr>
			            </thead>
						<tbody>
							@foreach($activities as $activity)
							<tr>
								<td>{{ $activity->name }}</td>
								<td>{{str_limit($activity->description, $limit = 20, $end = '...')}}</td>
								<td>{{ $activity->min_age }}</td>
								<td>{{ $activity->max_age }}</td>
								<td>{{ $activity->price }}</td>
								<td>{{ $activity->start_date }}</td>
								<td>{{ $activity->end_date }}</td>
								<td>{{ $activity->duration }}</td>
								<td>{{ $activity->available }}</td>
								<td>{{ $activity->requirements }}</td>
								<td>{{ $activity->fixed_start }}</td>
								<td>{{str_limit($activity->address, $limit = 20, $end = '...')}}</td>
								{{--<td>{{ $activity->organization->name }}</td>--}}
								@if(isset($activity->category->name))
								<td>{{ $activity->category->name }}</td> 
								@else
								<td>Категорията е премахната</td>
								@endif
								@if(isset($activity->subcategory->name))
								<td>{{ $activity->subcategory->name }}</td> 
								@else
								<td>Подкатегорията е премахната</td>
								@endif
								<td>
									@foreach ($activity->photos as $photo)
										{{-- @if ($photo->purpose_id == 1) --}}
										@if ($photo->purpose->description == 'mine')
											<img src="{{ asset('user_files/images/activity/' . $photo->image_path) }}" alt="{{$photo->alt}}" width="50" height="30" />
										@endif
									@endforeach
								</td>
								<td>
									{{ (isset($activity->approved_at)) ? 'Одобрена': 'Неодобрена' }}
									@if(Auth::user()->hasAnyRole(['admin','moderator']))
									@if(!$activity->approved_at)
										<a class="btn btn-warning btn-sm" href="{{ route('activities.approve',$activity->activity_id)}}">Одобри</a>
									@else
										<a class="btn btn-info btn-sm" href="{{ route('activities.unApprove',$activity->activity_id)}}">Премахни одобрение</a>
									@endif
									@endif
								</td>
								<td><a class="btn btn-primary btn-sm" href="{{ route('group.review', $activity->activity_id)}}">Групи</a></td>
								<td><a class="btn btn btn-info btn-sm" href="{{ route('activities.show',$activity->activity_id)}}">Преглед</a></td>
								<td><a class="btn btn-success btn-sm" href="{{ route('activities.edit',$activity->activity_id)}}">Редактирай</a></td>
									{{-- @if( Auth::user()->hasRole('admin')||Auth::user()->hasRole('moderator')) --}}
									{{-- 	@if(!$activity->approved_at)
									<a class="btn btn-warning btn-sm" href="{{ route('activities.approve',$activity->activity_id)}}">Одобри</a>
										@endif --}}
									{{-- @endif --}}
									{{-- @if( Auth::user()->hasRole('admin')) --}}
								<td>
									<form style="display: inline-block" method="POST" action="{{ 	route('activities.destroy',$activity->activity_id) }}" onsubmit="return ConfirmDelete('{{ 'активност '.$activity->name }}')">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<input class="btn btn-danger btn-sm" type="submit" name="submit" value="Изтрий">
									</form>
									{{-- @endif --}}
								</td>
							</tr>
							@endforeach
						</tbody>
			        </table>
			    </div>
	    	</div>
    	</div>
    <!--End Advanced Tables -->
    </div>
</div>

@endsection