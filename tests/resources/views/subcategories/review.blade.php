@extends('layouts.admin')

@section('title', 'Администриране на подкатегории към категория '.$category->name)

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
            	
            	<span>Категория: {{$category->name}}</span>
                
                
				<a href="{{ route('subcategorycategory.create', $category->category_id)}}">Създай нова подкатегория</a>
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
			            		<th>Подкатегория</th>
								<th>Описание</th>
								<th>Редактирай</th>
								<th>Изтрии</th>
							</tr>
			            </thead>
						<tbody>
							@forelse($category->subcategories as $subcategory)
							<tr>
								<td>{{ $subcategory->name }}</td>
								<td>{{ $subcategory->description }}</td>
								<td>
									<a class="btn btn-success btn-sm" href="{{ route('subcategory.edit',$subcategory->subcategory_id)}}">Редактирай</a>
								</td>
								<td>
									<form style="display: inline-block" method="POST" action="{{ route('subcategory.destroy',$subcategory->subcategory_id) }}" onsubmit="return ConfirmDelete('{{ 'подкатегория '.$subcategory->name }}')">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<input class="btn btn-danger btn-sm" type="submit" name="submit" value="Изтрий">
									</form>	
								</td>
							</tr>
							@empty
							
								<td colspan="5">Все още няма създадени подкатегории</td>
							
							@endforelse
						</tbody>
			        </table>
			       
			        <a class="btn btn-success btn-sm" href="{{ route('category.show', $category->category_id)}}">Преглед</a>
			        
			    </div>
    		</div>
    	</div>
    <!--End Advanced Tables -->
    </div>
</div>



@endsection