@extends('layouts.admin')

@section('title', 'Администриране на активности')

@section('content')
<div class="row">
    <div class="col-md-12">
		<p><a href="{{ route('activities.create')}}" class=" btn btn-warning btn-md">Създай нова активност</a></p>
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Всички активности
				
            </div>
	        <div class="panel-body">
				<div class="table-responsive">
					@if(session()->has('message'))
			    		<div class="alert alert-success">
			       			 {{ session()->get('message') }}
			    		</div>   
					@endif
			        <table class="table table-striped table-bordered table-hover" id="table_activities">
			            <thead>
			                <tr>
			            		<th>Активност</th>
								<th>Наличен</th>
								<th>Организация</th>
								<th>Категория</th>
								<th>Подкатегория</th>
								<th>Създадена на</th>
								<th>Снимка</th>
								<th>Статус</th>
								<th>Управление</th>
							</tr>
			            </thead>
						<tbody>
							@foreach($activities as $activity)
							<tr>
								<td>{{ str_limit($activity->name, 40) }}</td>
								<td>{{ $activity->available }}</td>
								<td>
									@isset($activity->organization->name)
									{{ $activity->organization->name }}
									@endisset
								</td>
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
								<td>{{Carbon\Carbon::parse( $activity->created_at)->format('d m Y H:i') }}</td> 
								<td>
									@foreach ($activity->photos as $photo)
										@if ($photo->purpose->description == 'mine')
											<img src="{{ asset('user_files/images/activity/' . $photo->image_path) }}" alt="{{$photo->alt}}" width="50" height="30" />
										@endif
									@endforeach
								</td>
								<td>
									{{ (isset($activity->approved_at)) ? 'Одобрена': 'Неодобрена' }}
								</td>
								<td>
									<a class="btn btn-primary btn-sm btn-block" href="{{ route('group.review', $activity->activity_id)}}">Групи</a>
									<a class="btn btn btn-info btn-sm btn-block" href="{{ route('activities.show',$activity->activity_id)}}" target="_blank">Преглед</a>
									<a class="btn btn-success btn-sm btn-block" href="{{ route('activities.edit',$activity->activity_id)}}">Редактирай</a>
									@if(Auth::user()->hasAnyRole(['admin','moderator']))
									@if(!$activity->approved_at)
										<a class="btn btn-warning btn-sm btn-block" href="{{ route('activities.approve',$activity->activity_id)}}">Одобри</a>
									@else
										<a class="btn btn-info btn-sm btn-block" href="{{ route('activities.unApprove',$activity->activity_id)}}">Премахни одобрение</a>
									@endif
									@endif
									<form  method="POST" action="{{ 	route('activities.destroy',$activity->activity_id) }}" onsubmit="return ConfirmDelete('{{ 'активност '.$activity->name }}')">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<input class="btn btn-danger btn-sm btn-block" type="submit" name="submit" value="Изтрий">
									</form>
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