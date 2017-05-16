@extends('master')

@section('content')

<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">{{ $section->section_name }} Section.</div>
		<div class="panel-body">
				@if(count($errors)>0)
					<div class="alert alert-danger">
						<ul>
							@foreach($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
			<table class="table">
				@if (Auth::check())
				<tr>
				{!! Form::open(['url' => 'books']) !!}
				{!! Form::hidden('section_id', $section->id)!!}
				{!! Form::label('book_title', 'Enter the title of the book : ') !!}
				{!! Form::text('book_title', '', ["class"=>"form-control"]) !!} <br>
				{!! Form::label('book_edition', 'Enter the edition number : ') !!}
				{!! Form::text('book_edition', '', ["class"=>"form-control"]) !!} <br>		{!! Form::label('book_publication', 'Enter the publication date : ') !!}
				{!! Form::date('book_publication', '', ["class"=>"form-control"]) !!} <br>
				{!! Form::label('book_description', 'Enter the description of the book : ') !!}
				{!! Form::text('book_description', '', ["class"=>"form-control"]) !!} <br>
				{!! Form::label('another_author', 'Enter another author : ') !!}
				{!! Form::text('another_author', '', ["class"=>"form-control"]) !!} <br>
				{!! Form::submit('Add', ['class'=>'btn btn-info']) !!}
				{!! Form::close() !!}
				</tr>
				@endif
				<tr><h3>Number Of Books : <span class="label label-info">{{ $section->books_total }}</span></h3></tr>
				<tr>
					<th><h3>Book Title</h3></th>
					<th><h3>Book Edition</h3></th>
					<th><h3>Book Publication</h3></th>
					<th><h3>Book Description</h3></th>
					<th></th>
					<th></th>
				</tr>
				@if (Auth::check())
				<?php $i=0; ?>
				@foreach($all_books as $book)
				<tr><!-- Form for Update book-->
					{!! Form::open(['url'=>'books/'.$book->id, 'method'=>'PATCH'])!!}
					{!! Form::hidden('section_id', $section->id) !!}
					<td>{!! Form::text('book_title', $book->book_title, 
									["class"=>"form-control"]) !!}</td>
					<td>{!! Form::text('book_edition', $book->book_edition, 
									["class"=>"form-control"]) !!}</td>
					<td>{!! Form::text('book_publication', $book->book_publication, 
									["class"=>"form-control"]) !!}</td>
					<td>{!! Form::textarea('book_description', $book->book_description, 
									["class"=>"form-control"]) !!}</td>
					<td>
						<?php $authors = $array_of_authors[$i]; ?>
						@foreach($authors as $author)
						<a href="/authors/{{ $author->id }}">
							<span class="label label-info">{{ $author->first_name }}</span>
						</a>
						@endforeach
						<?php $i++; ?>
					</td>
					<td>{!! Form::submit('Update', ['class'=>'btn btn-info']) !!}</td>
					{!! Form::close() !!}
					<!-- Form for Delete book-->
					{!! Form::open(['url'=>'books/'.$book->id, 'method'=>'DELETE'])!!}
					{!! Form::hidden('section_id', $section->id) !!}
					<td>{!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}</td>
					{!! Form::close() !!}
				</tr>
				@endforeach
				@else
					<?php $i=0; ?>
					@foreach($all_books as $book)
					<tr>
						<td>{!! $book->book_title !!}</td>
						<td>{!! $book->book_edition !!}</td>
						<td>{!! $book->book_publication !!}</td>
						<td>{!! $book->book_description !!}</td>
						<td>
							<?php $authors = $array_of_authors[$i]; ?>
							@foreach($authors as $author)
							<a href="/authors/{{ $author->id }}">
								<span class="label label-info">{{ $author->first_name }}</span>
							</a>
							@endforeach
							<?php $i++; ?>
						</td>
					</tr>
					@endforeach
				@endif
			</table>
			<div class="text-center">
				{{ $all_books->links() }}
			</div>
		</div>
	</div>
</div>
@stop