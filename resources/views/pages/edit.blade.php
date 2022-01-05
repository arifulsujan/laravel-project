@extends('layouts.master')

@section('content')
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{route('blogs.index')}}" class="btn btn-primary my-3">Show All blog</a>
            <form action="{{route('blogs.update',$blog->id)}}" method="post" enctype="multipart/form-data">
               @method('put')
                @csrf
                <div class="form-group my-2">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control" value="{{$blog->title}}">
                    @error('title')
                        <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group my-2">
                    <label for="">Description</label>
                    <input type="text" name="description" class="form-control" value="{{$blog->description}}">
                </div>
                <div class="form-group my-2">
                    <input type="file" name="image" class="form-control">
                </div>
                <span>
                    <img src="{{asset('uploads/blog/'.$blog->image)}}" alt="no image" height="75 px" width="75px">
                </span>
                <div class="form-group my-2">
                    <input type="submit" value="Update" class="form-control btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
