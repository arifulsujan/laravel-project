@extends('layouts.master')
@section('title','Single Blog Post')

@section('content')

<div class="container class="mt-5"">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>{{$blog->title}}</h1>
            <h2 class="mt-2">
                <img src="{{asset('uploads/blog/'.$blog->image)}}" alt="no image" height="500px" width="500px">
            </h2>
            <p> {{$blog->description}}</p>

        </div>
    </div>
</div>
    
@endsection
    
