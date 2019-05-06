@extends('layouts.admin')

@section('title', 'Администриране на категории')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Всички категории
				<a href="{{ route('category.create')}}">Създай нова категория</a>
            </div>
	        <div class="panel-body">
				<div class="table-responsive">
					@if(session()->has('message'))
			    		<div class="alert alert-success">
			       			 {{ session()->get('message') }}
			    		</div>   
					@endif
			        <table class="table table-striped table-bordered table-hover" id="table_categories">
			            <thead>
			                <tr>
			            		<th>Име</th>
								<th>Описание</th>
								<th>Подкатегории</th>
								<th>Преглед</th>
								<th>Редактирай</th>
								<th>Изтрии</th>
							</tr>
			            </thead>
						<tbody>
							@foreach($categories as $category)
							<tr>
								<td>{{ $category->name }}</td>
								<td>{{str_limit($category->description, $limit = 20, $end = '...')}}</td>
								<td><a class="btn btn-warning btn-sm" href="{{ route('subcategory.review',$category->category_id)}}">Подкатегории</a></td>
								<td>
									<a class="btn btn btn-info btn-sm" href="{{ route('category.show',$category->category_id)}}">Преглед</a>
								</td>
								<td>
									<a class="btn btn-success btn-sm {{ (!Auth::user()->hasRole('admin')) ? 'disabled' : ''}}" href="{{ route('category.edit',$category->category_id)}}">Редактирай</a>
								</td>
								<td>
									<form style="display: inline-block" method="POST" action="{{ route('category.destroy',$category->category_id) }}" onsubmit="return ConfirmDelete('{{ 'категория '.$category->name }}')">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<input class="btn btn-danger btn-sm {{ (!Auth::user()->hasRole('admin')) ? 'disabled' : ''}}" href="{{ route('category.edit',$category->category_id)}}" type="submit" name="submit" value="Изтрий">
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