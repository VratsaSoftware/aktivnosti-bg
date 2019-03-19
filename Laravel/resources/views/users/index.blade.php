@extends('layouts.adminMaster')

@section('pageheader')
Users Admin Panel
@endsection

@section('content')
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>   
@endif
<div style="width: 95%; margin:auto;">
<table id="table_id" class="display compact hover cell-border"  style="width:100%">
<thead>
	<tr>
		<th>Name</th>
		<th>Family</th>
		<th>Email</th>
		<th>Address</th>
		<th>Phone</th>
		<th>Photo</th>
		<th>Approved</th>
		<th>Role</th>
<th colspan=2>Manage</th>
	</tr>
</thead>
<tbody>

	@foreach($users as $user)
	<tr>
		<td><a>{{ $user->name }}</a></td>
		<td>{{ $user->family }}</td>
		<td>{{ $user->email }}</td>
		<td>{{ $user->address }}</td>
		<td>{{ $user->phone }}</td>
		<td><img src="{{ public_path().$user->photo->image_path }}"></td>
		<td>{{ ($user->approved_at) ? 'Approved': 'Not Approved' }}</td>
		<td>{{ $user->role->role }}</td>
		<td><a class="btn btn-success" href="{{ route('users.edit',$user->user_id)}}">Edit</a></td>
		<td>
			<form method="POST" action="{{ route('users.destroy',$user->user_id) }}">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}
			<input class="btn btn-danger" type="submit" name="submit" value="Remove">
			</form>
		</td>
	</tr>
	@endforeach
</tbody>

</table>

	<a class="btn btn-primary" href="{{ route('users.create')}}">Create</a>
	<a class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
</div>

@endsection

	