@extends('layouts.admin')

@section('title', 'Категория и подкатегории')

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
			        <table class="table table-striped table-bordered table-hover" id="table_subCategories">
			            <thead>
			                <tr>
								<th>Категория</th>
								<th>Описание</th>
								<th>Подкатегория</th>
								<th>Описание</th>
							</tr>
			            </thead>
						<tbody>
							<tr>	
								<td><p>{{ $category->name }}</p></td>
								<td><p>{{ $category->description }}</p></td>
								<td>
									@foreach($category->subcategories as $subcategory)
									<p>{{ $subcategory->name }}</p>
									@endforeach
								</td>
								<td>
									@foreach($category->subcategories as $subcategory)
									<p>{{ $subcategory->description }}</p>
									@endforeach
								</td>
							</tr>
						</tbody>
			        </table>
			    </div>
    		</div>
    	</div>
    <!--End Advanced Tables -->
    </div>
</div>

@endsection