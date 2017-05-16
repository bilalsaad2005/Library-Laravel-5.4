@extends('master')

@section('content')

<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">Author Page.</div>
		<div class="panel-body">
			<table class="table">
				<tr><h1>Wellcome {{ $author->first_name }} {{ $author->last_name }}.</h1></tr>
				<tr><td><h3>Info. Details :</h3></td></tr>
				<tr>
					<td>
						<dl class="dl-horizontal">
	  						<dt>First Name : </dt>
	  						<dd>{{ $author->first_name }}</dd>
						</dl>
					</td>
					<td>
						<dl class="dl-horizontal">
	  						<dt>Last Name : </dt>
	  						<dd>{{ $author->last_name }}</dd>
						</dl>
					</td>
				</tr>
				<tr>
					<td>
						<dl class="dl-horizontal">
	  						<dt>Date Of Birth : </dt>
	  						<dd>{{ $author->DOB }}</dd>
						</dl>
					</td>
					<td>
						<dl class="dl-horizontal">
	  						<dt>Address : </dt>
	  						<dd>{{ $author->address }}</dd>
						</dl>
					</td>
				</tr>
				<tr>
					<td>
						<h3>The Books you wrote : <span class='label label-success'>{!! $i !!}</span></h3>
					</td>
				</tr>
				<table class="table table-bordered table-hover">
					<tbody>
					@foreach($array_of_books as $book)
						<tr>
							<td>
								{!! $book !!}
							</td>
						</tr>
					@endforeach					
					</tbody>
				</table>
			</table>
		</div>
	</div>
</div>
@stop