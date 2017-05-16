@extends('master')

@section('content')

<div class="container">
<div class="panel panel-default">
	<div class="panel-heading">Library</div>
	<div class="panel-body">
	<h1 class="well text-center">Library Summary</h1>
	<table class="table">
		<tr>
			<th style="width: 25%">Section name</th>
			<th style="width: 25%">Book title</th>
			<th style="width: 25%">Book description</th>
			<th style="width: 25%">Author(s)</th>
		</tr>
		@foreach($results as $bookModel)
		<tr>
			<td>
				<a href="library/{{ $bookModel->section->id }}">
					<span class="label label-info">{{ $bookModel->section->section_name }}</span>
				</a>
			</td>
			<td>
				{{ $bookModel->book_title }}
			</td>
			<td>
				{{ $bookModel->book_description }}
			</td>
			<td>
			<?php $authors = $bookModel->authors ?>
			@foreach($authors as $author)
				<a href="authors/{{ $author->id }}">
					<span class="label label-danger">{{ $author->first_name }} {{ $author->last_name}}</span>
				</a>
			@endforeach
			</td>

		</tr>
		@endforeach

	</table>
	<div style="text-align: center;">{!! $results->render() !!}</div>
	</div>
	</div>
</div>
@stop