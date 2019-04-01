@extends('layouts.admin')

@section('title', 'Администриране на организации')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Всички Организации
				<a href="{{ route('organizations.create')}}">Създай нова организация</a>
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
					<th>Сайт</th>
					<th>Поща</th>
					<th>Адрес</th>
					<th>Телефон</th>
					<th>Снимка</th>
					<th>Одобрен</th>
					<th>Преглед</th>
					<th>Управление</th>
				</tr>
            </thead>
			<tbody>
				@foreach($organizations as $organization)
				<tr>
					<td>{{ $organization->name }}</td>
					<td>{{ $organization->website }}</td>
					<td>{{ $organization->email }}</td>
					<td>{{ $organization->address }}</td>
					<td>{{ $organization->phone }}</td>
					<td>
					@foreach($organization->photos as $photo)
						@if(isset($photo->image_path))
						<img src="{{ asset('/user_files/images/organization/').'/'.$photo->image_path }}" alt="{{ $photo->purpose->description }}"
						width="50" height="30">
						@else
						<span>Няма снимка</span>
						@endif
					@endforeach
					</td>
					<td>{{ (isset($organization->approved_at)) ? 'Одобрена': 'Неодобрена' }}</td>
					<td>
						<a class="btn btn btn-info btn-sm" href="{{ route('organizations.show',$organization->organization_id)}}">Преглед</a>
						</td>
					<td>
						<a class="btn btn-success btn-sm" href="{{ route('organizations.edit',$organization->organization_id)}}">Редактирай</a>
						@if( Auth::user()->hasRole('admin')||Auth::user()->hasRole('moderator'))
							@if(!$organization->approved_at)
						<a class="btn btn-warning btn-sm" href="{{ route('organizations.approve',$organization->organization_id)}}">Одобри</a>
							@endif
						@endif
						@if( Auth::user()->hasRole('admin'))
						<form style="display: inline-block" method="POST" action="{{ 	route('organizations.destroy',$organization->organization_id) }}">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<input class="btn btn-danger btn-sm" type="submit" name="submit" value="Изтрий">
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