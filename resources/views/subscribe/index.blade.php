@extends('layouts.admin')

@section('title', 'Администриране на абонати')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Всички абонаменти
            </div>
	        <div class="panel-body">
				<div class="table-responsive">
					@if(session()->has('message'))
			    		<div class="alert alert-success">
			       			 {{ session()->get('message') }}
			    		</div>   
					@endif
			        <table class="table table-striped table-bordered table-hover" id="subscribe">
			            <thead>
			                <tr>
			            		<th>Абонамент за</th>
								<th>Имейл</th>
								<th>Дата</th>
								<th>Управление</th>
							</tr>
			            </thead>
						<tbody>
							@foreach($newsletters as $newsletter)
							<tr>
								@php($name = $newsletter->desired_type::find($newsletter->desired_id))
								<td>{{ $name->name }}</td>
								<td>{{ $newsletter->subscription->email}}</td>								
								<td>{{ $newsletter->subscription->created_at}}</td>
								<td>
									<form  method="POST" action="{{ 	route('subscription.destroy',$newsletter->newsletter_id) }}" onsubmit="return ConfirmDelete('{{ 'Абонамент '.$newsletter->subscription->email }}')">
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