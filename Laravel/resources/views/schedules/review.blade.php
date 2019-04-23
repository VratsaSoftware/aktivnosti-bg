@extends('layouts.admin')

@section('title', 'Администриране на разписания към група '.$group->name)

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
            	<span>Активност: {{$group->activity->name}}   </span>
            	<span>   Група: {{$group->name}}</span>
                
                
				<a href="{{ route('schedulegroup.create', $group->group_id)}}">Създай ново разписание</a>
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
			            		<th>Ден</th>
								<th>Начален час</th>
								<th>Краен час</th>
								<th>Редактирай</th>
								<th>Изтрии</th>
							</tr>
			            </thead>
						<tbody>
							@forelse($group->schedules as $schedule)
							<tr>
								<td>{{ $schedule->day }}</td>
								<td>{{ $schedule->start_time }}</td>
								<td>{{ $schedule->end_time }}</td>
								<td>
									<a class="btn btn-success btn-sm" href="{{ route('schedule.edit',$schedule->schedule_id)}}">Редактирай</a>
								</td>
								<td>
									<form style="display: inline-block" method="POST" action="{{ route('schedule.destroy',$schedule->schedule_id) }}" onsubmit="return ConfirmDelete('{{ 'разписание за '.$schedule->day.' от '.$schedule->start_time.' до '.$schedule->end_time }}')">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<input class="btn btn-danger btn-sm" type="submit" name="submit" value="Изтрий">
									</form>	
								</td>
							</tr>
							@empty
							
								<td colspan="5">Все още няма създадени разписания</td>
							
							@endforelse
						</tbody>
			        </table>
			       
			        <a class="btn btn-success btn-sm" href="{{ route('group.show', $group->activity->activity_id)}}">Преглед</a>
			        <a class="btn btn-primary btn-sm" href="{{ route('group.review', $group->activity->activity_id)}}">Групи</a>
			    </div>
    		</div>
    	</div>
    <!--End Advanced Tables -->
    </div>
</div>



@endsection