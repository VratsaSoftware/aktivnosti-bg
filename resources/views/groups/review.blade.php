@extends('layouts.admin')

@section('title', 'Администриране на групи към '.$activity->name)

@section('content')
<div class="row">
    <div class="col-md-12">
		<p><a href="{{ route('groupactivity.create', $activity->activity_id)}}" class=" btn btn-warning btn-md">Създай нова група</a></p>
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Активност: {{$activity->name}}
            </div>
        	<div class="panel-body">
				<div class="table-responsive">
					@if(session()->has('message'))
			    		<div class="alert alert-success">
			       			 {{ session()->get('message') }}
			    		</div>
					@endif
			        <table class="table table-striped table-bordered table-hover" id="table_groups">
			            <thead>
			                <tr>
			            		<th>Група</th>
								<th>Описание</th>
                                <th>Дневник</th>
								<th>Разписания</th>
								<th>Редактирай</th>
								<th>Изтрии</th>
							</tr>
			            </thead>
						<tbody>
						@isset($activity->groups)
							@foreach($activity->groups as $group)
							<tr>
								<td>{{ $group->name }}</td>
								<td>{{ $group->description }}</td>
                                <td>
                                    {!! (isset($group->created_at)) ?'<b>Създадена на:</b><br>'.$group->created_at.'</b><br>' : '' !!}
                                    @if(Auth::user()->hasAnyRole(['admin','moderator']))
                                    {!! (isset($group->updated_by)) ?'<b>Променена от:</b><br>'.$group->updated_by.'<br>' : ''  !!}
                                    @endif
                                    {!! !empty($group->updated_at) ? '<b>Променена на:</b><br>'.$group->updated_at.'<br>' : '' !!}
                                </td>
								<td><a class="btn btn-warning btn-sm" href="{{ route('schedule.review',$group->group_id)}}">Разписания</a></td>
								<td>
									<a class="btn btn-success btn-sm" href="{{ route('group.edit',$group->group_id)}}">Редактирай</a>
								</td>
								<td>
									<form style="display: inline-block" method="POST" action="{{ 	route('group.destroy',$group->group_id) }}" onsubmit="return ConfirmDelete('{{ 'група '.$group->name }}')">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<input class="btn btn-danger btn-sm" type="submit" name="submit" value="Изтрий">
									</form>
								</td>
							</tr>
							@endforeach
						@endisset
						</tbody>
			        </table>
			        <a class="btn btn-success btn-sm" href="{{ route('group.show', $activity->activity_id)}}">Преглед</a>
			    </div>
    		</div>
    	</div>
    <!--End Advanced Tables -->
    </div>
</div>



@endsection
