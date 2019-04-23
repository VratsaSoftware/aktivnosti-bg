@extends('layouts.admin')

@section('title', 'Групи и разписания към '.$activity->name)

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
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
								<th>Ден от седмицата</th>
								<th>Начален час</th>
								<th>Краен час</th>
							</tr>
			            </thead>
						<tbody>
							@foreach($activity->groups as $group)
							<tr>	
								<td><p>{{ $group->name }}</p></td>
								<td><p>{{ $group->description }}</p></td>
								<td>@foreach($group->schedules as $schedule)<p>{{ $schedule->day }}</p>@endforeach</td>
								<td>@foreach($group->schedules as $schedule)<p>{{ $schedule->start_time }}</p>@endforeach</td>
								<td>@foreach($group->schedules as $schedule)<p>{{ $schedule->end_time }}</p>@endforeach</td>	
							</tr>
							@endforeach
						</tbody>
			        </table>
			        <a class="btn btn-success btn-sm" href="{{ route('group.review', $activity->activity_id)}}">Групи</a>
			    </div>
	    	</div>
    	</div>
    <!--End Advanced Tables -->
    </div>
</div>



@endsection