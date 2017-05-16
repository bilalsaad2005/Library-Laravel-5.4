@extends('master')

@section('content')

<div class="container">
<script type="text/javascript" src="{{ asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#errorMsgs').hide();
		var files;
		$('input[name="image"]').change(function(e){
			files = e.target.files;
		});
		$('#createSection').submit(function(e){
			e.preventDefault();
			var _token = $('input[name="_token"]').val();
			var section_name = $('input[name="section_name"]').val();
			var data = new FormData();
			data.append('_token', _token);
			data.append('section_name', section_name);
			$.each(files, function(k,v){ data.append('image', v); });
			console.log(data);
			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			$.ajax({
				url: 'store',
				type: 'POST',
				contentType: false,
				data: data,
				processData: false,
				success: function(data){
					alert('Section Created Successfuly!');
					console.log('Section Created Successfuly!');
				},
				error: function(data){
					$('#errorMsgs').show();
					$('#errorMsgs').html('');
					var errors = data.responseJSON;
					$.each(errors, function(k, v){
						$('#errorMsgs').append(v+"<br />");
						console.log(v);
					});
				},
			});
		});
	});
</script>
	<div class="panel panel-default">
		<div class="panel-heading">Managing sections</div>
		<div class="panel-body">
		<div class="alert alert-danger" id="errorMsgs"></div>
		@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
			<h2><br>Creating new section</h2><hr>
			<!-- Creating New Section -->
			{!! Form::open(['url' => 'library', 'method' => 'POST', 'files' => true, 'id' => 'createSection']) !!}
			{!! Form::label('section_name', 'Enter the name of the section : ') !!}
			{!! Form::text('section_name', '', ["class"=>"form-control"]) !!} <br>
			{!! Form::label('image', 'Upload an image : ') !!}
			{!! Form::file('image') !!} <br>
			{!! Form::submit('Create', ['class'=>'btn btn-info']) !!}
			{!! Form::close() !!}
		</div>
		<!-- Checking for Section to print out-->
		@if($sections != null)
		<table class="table">
			<tr>
				<th><h3>Section Name</h3></th>
				<th><h3>Total Books</h3></th>
				<th><h3>Update</h3></th>
				<th><h3>Delete</h3></th>
				<th></th>
			</tr>
		<!--  Create a table -->
			@foreach($sections as $section)
			<!-- Checking For Trashed Sections-->
			@if($section->trashed())
				<tr style="background-color: #b71c1c">
			@else
				<tr style="background-color: #ffffff">
			@endif 
				<!-- Form for update  -->
				{!! Form::open(['url'=>"library/".$section->id, 'method'=>'PATCH']) !!}
				<td>{!! Form::text('section_name', $section->section_name, ["class"=>"form-control"]) !!}</td>
				<td><h4><span class='label label-default'>{!! $section->books_total !!}</span></h4></td>
				<td>{!! Form::submit('Update', ['class'=>'btn btn-info']) !!}</td>
				{!! Form::close() !!}
				<!-- Form for delete with trashed to delete forever-->
				@if($section->trashed())
					{!! Form::open(['url'=>"library/delete-forever/".$section->id, 'method'=>'POST']) !!}
					<td>{!! Form::submit('Delete Forever', ['class'=>'btn btn-danger']) !!}</td>
					{!! Form::close() !!}
				@else
					{!! Form::open(['url'=>"library/".$section->id, 'method'=>'DELETE']) !!}
					<td>{!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}</td>
					{!! Form::close() !!}
				@endif
				<!-- Form to restore-->
				@if($section->trashed())
					{!! Form::open(['url'=>"library/restore/".$section->id, 'method'=>'POST']) !!}
					<td>{!! Form::submit('Restore', ['class'=>'btn btn-default']) !!}</td>
					{!! Form::close() !!}
				@endif
				<td><a href="library/{{$section->id}}" class="btn btn-default">Show</a></td>
			</tr>
			@endforeach
		</table>
		@endif
	</div>
</div>
@stop