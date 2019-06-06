@extends('layouts.admin')

@section('title', 'Администриране на новини')

@section('content')
<div class="row">
    <div class="col-md-12">
	<p><a href="{{ route('news.create')}}" class=" btn btn-warning btn-md">Създай новина</a></p>
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Всички Новини
            </div>
        <div class="panel-body">
	<div class="table-responsive">
		@if(session()->has('message'))
    		<div class="alert alert-success">
       			 {{ session()->get('message') }}
    		</div>   
		@endif
        <table class="table table-striped table-bordered table-hover" id="table_news_adminOrg">
            <thead>
                <tr>
            		<th>Заглавие</th>
					<th>Принадлежи на</th>
					<th>Снимка</th>
					<th>Одобрен</th>
					<th>Управление</th>
				</tr>
            </thead>
			<tbody>
				@foreach($news as $one_news)
				<tr>
					<td>{{ $one_news->heading }}</td>
					@if(isset($one_news->article_type::find($one_news->article_id)->name))
					<td>{{ $one_news->article_type::find($one_news->article_id)->name }}</td>
					@else
					<td>...</td>
					@endif
					<td>				
					@foreach($one_news->photos as $photo)
						@if($photo->purpose->description == 'front')	
						<img src="{{ asset('/user_files/images/news/').'/'.$photo->image_path }}" alt="{{ $photo->purpose->description }}"
						width="50" height="30">
						@endif
					@endforeach
					</td>
					<td>{{ (isset($one_news->approved_at)) ? 'Одобрена': 'Неодобрена' }}</td>
					
					<td>
						<a class="btn btn btn-info btn-block btn-sm" href="{{ route('news.show',$one_news->news_id)}}">Преглед</a>
						<a class="btn btn-success btn-sm btn-block" href="{{ route('news.edit',$one_news->news_id)}}">Редактирай</a>
						@if(Auth::user()->hasAnyRole(['admin','moderator']))
							@if(!$one_news->approved_at)
						<a class="btn btn-warning btn-sm btn-block" href="{{ route('news.approve',$one_news->news_id)}}">Одобри</a>
							@else
						<a class="btn btn-info btn-sm btn-block" href="{{ route('news.unApprove',$one_news->news_id)}}">Премахни одобрение</a>
							@endif
						@endif
						@if( Auth::user()->hasRole('admin'))
						<form  method="POST" action="{{ 	route('news.destroy',$one_news->news_id) }}" onsubmit="return ConfirmDelete('{{ 'новина '.$one_news->name }}')">
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