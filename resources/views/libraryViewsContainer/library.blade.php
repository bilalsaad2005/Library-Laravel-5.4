@extends('master')

@section('content')
      <div class="container" style="opacity: 0.9">
          <div class="row">
          @if(count($sections) > 0)
            @foreach($sections as $section)
                <div class="col-md-3">
                    <div class="thumbnail">
                        <img src="{{asset('images/'.$section->image_name)}}" width="250px" height="300px">
                        <h1>
                          <a href="library/{{ $section->id }}" class="btn btn-primary">
                          {{ $section->section_name}}</a>
                        </h1>
                    </div>
                </div>
            @endforeach
          @else
          <div class="label">
            <h1>Please, Add New Section</h1>
          </div>
          @endif
          </div>
      </div>
@stop
