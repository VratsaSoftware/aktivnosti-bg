@extends('layouts.admin')

@section('title', 'Администриране на организации')

@section('content')
<div class="row">
    <div class="col-md-12">
	<p><a href="{{ route('organizations.create')}}" class=" btn btn-warning btn-md">Създай нова организация</a></p>
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Всички Организации
				
            </div>
        <div class="panel-body">
	<div class="table-responsive">
		@if(session()->has('message'))
    		<div class="alert alert-success">
       			 {{ session()->get('message') }}
    		</div>   
		@endif
        <table class="table table-striped table-bordered table-hover" id="table_organizations_adminOrg">
            <thead>
                <tr>
            		<th>Организация</th>
					<th>Поща</th>
					<th>Адрес</th>
					<th>Телефон</th>
					<th>Снимка</th>
					<th>Одобрен</th>
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
					
					@foreach($organization->photos as $photo)
					
						@if($photo->purpose->description == 'logo')	
						<img src="{{ asset('/user_files/images/organization/').'/'.$photo->image_path }}" alt="{{ $photo->purpose->description }}"
						width="50" height="30">
						@endif
					@endforeach
					</td>
					<td>{{ (isset($organization->approved_at)) ? 'Одобрена': 'Неодобрена' }}</td>
						
					<td>
						<a class="btn btn btn-info btn-sm btn-block" href="{{ route('organizations.show',$organization->organization_id)}}" target="_blank">Преглед</a>

						<a class="btn btn-success btn-sm btn-block" href="{{ route('organizations.edit',$organization->organization_id)}}">Редактирай</a>
						@if( Auth::user()->hasRole('admin')||Auth::user()->hasRole('moderator'))
							@if(!$organization->approved_at)
						<a class="btn btn-warning btn-sm btn-block" href="{{ route('organizations.approve',$organization->organization_id)}}">Одобри</a>
							@endif
						@endif
						@if( Auth::user()->hasRole('admin'))
						<form method="POST" action="{{ 	route('organizations.destroy',$organization->organization_id) }}" onsubmit="return ConfirmDelete('{{ 'организация '.$organization->name.' '.$organization->email }}')">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<input class="btn btn-danger btn-sm btn-block" type="submit" name="submit" value="Изтрий">
						</form>
						@endif
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