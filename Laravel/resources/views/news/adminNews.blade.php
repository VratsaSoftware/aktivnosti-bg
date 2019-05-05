@extends('layouts.admin')

@section('title', 'Администриране на новини')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Всички Новини
				<a href="{{ route('news.create')}}">Създай новина</a>
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
					<th>Преглед</th>
					<th>Управление</th>
				</tr>
            </thead>
			<tbody>
				@foreach($news as $news)
				<tr>
					<td>{{ $news->heading }}</td>
					<td>{{ $news->article_type::find($news->article_id)->name }}</td>
					<td>				
					@foreach($news->photos as $photo)
						@if($photo->purpose->description == 'front')	
						<img src="{{ asset('/user_files/images/news/').'/'.$photo->image_path }}" alt="{{ $photo->purpose->description }}"
						width="50" height="30">
						@endif
					@endforeach
					</td>
					<td>{{ (isset($news->approved_at)) ? 'Одобрена': 'Неодобрена' }}</td>
					<td>
						<a class="btn btn btn-info btn-sm" href="{{ route('news.show',$news->news_id)}}">Преглед</a>
						</td>
					<td>
						<a class="btn btn-success btn-sm" href="{{ route('news.edit',$news->news_id)}}">Редактирай</a>
						@if(Auth::user()->hasAnyRole(['admin','moderator']))
							@if(!$news->approved_at)
						<a class="btn btn-warning btn-sm" href="{{ route('news.approve',$news->news_id)}}">Одобри</a>
							@else
						<a class="btn btn-info btn-sm" href="{{ route('news.unApprove',$news->news_id)}}">Премахни одобрение</a>
							@endif
						@endif
						@if( Auth::user()->hasRole('admin'))
						<form style="display: inline-block" method="POST" action="{{ 	route('news.destroy',$news->news_id) }}" onsubmit="return ConfirmDelete('{{ 'новина '.$news->name }}')">
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