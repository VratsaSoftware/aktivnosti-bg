@extends('layouts.admin')

@section('title', 'Администриране на групи към '.$activity->name)

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Активност: {{$activity->name}}
				<a href="{{ route('groupactivity.create', $activity->activity_id)}}">Създай нова група</a>
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
            		<th>Група</th>
					<th>Описание</th>
					<th>Разписания</th>
					<th>Редактирай</th>
					<th>Изтрии</th>
				</tr>
            </thead>
			<tbody>
				@foreach($activity->groups as $group)
				{{-- @if(isset($group)) --}}
				<tr>
					<td>{{ $group->name }}</td>
					<td>{{ $group->description }}</td>
					<td><a class="btn btn-warning btn-sm" href="{{ route('schedule.review',$group->group_id)}}">Разписания</a></td>
					{{-- <td>
						<a class="btn btn btn-info btn-sm" href="{{ route('group.show',$group->group_id)}}">Преглед</a>
					</td> --}}
					<td>
						<a class="btn btn-success btn-sm" href="{{ route('group.edit',$group->group_id)}}">Редактирай</a>
						{{-- @if( Auth::user()->hasRole('admin')||Auth::user()->hasRole('moderator')) --}}
						{{-- 	@if(!$activity->approved_at)
						<a class="btn btn-warning btn-sm" href="{{ route('activities.approve',$activity->activity_id)}}">Одобри</a>
							@endif --}}
						{{-- @endif --}}
						{{-- @if( Auth::user()->hasRole('admin')) --}}
					</td>
					<td>
						<form style="display: inline-block" method="POST" action="{{ 	route('group.destroy',$group->group_id) }}" onsubmit="return ConfirmDelete('{{ 'група '.$group->name }}')">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<input class="btn btn-danger btn-sm" type="submit" name="submit" value="Изтрий">
						</form>
						{{-- @endif --}}
					</td>
				</tr>
				{{-- @else
				<tr>
					<td rowspan="5">Все още няма създадени групи</td>
				</tr>
				@endif --}}
				@endforeach
			</tbody>
        </table>
        <a class="btn btn-success btn-sm" href="{{ route('group.show', $activity->activity_id)}}">Преглед</a>
        <a class="btn btn-primary btn-sm" href="{{ route('activities.manage')}}">Активности</a>
    </div>
    </div>
    </div>
    <!--End Advanced Tables -->
    </div>
</div>



@endsection