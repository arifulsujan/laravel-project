@extends('layouts.master')


@section('content')
<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{route('blogs.create')}}" class="btn btn-primary my-3">Create New Blog</a> <br>
            @if (Session::has('msg'))
            <span class="text-success">{{Session::get('msg')}}</span>
                
            @endif
            <table class="table table-bordered border-danger text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blog as $key=>$blogs)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$blogs->title}}</td>
                        <td>{{$blogs->description}}</td>
                        <td>
                            <img src="{{asset('uploads/blog/'.$blogs->image)}}" alt="No Image" width="70px" height="70px">
                        </td>
                        <td class="d-flex">
                            <a href="{{route('blogs.show',$blogs->id)}}" class="btn btn-success mx-2">View</a> 
                            <a href="{{route('blogs.edit',$blogs->id)}}" class="btn btn-info mx-2">Edit</a> 
                            
                            <form method="post" action="{{ route('blogs.destroy',$blogs->id)}}">
                                
                            @csrf
                            @method('delete')
                            
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('are you sure')">Move to Trash</button>
                            </form>
                        </td>
                    </tr>   
                    @endforeach
                   

                </tbody>
            </table>
            {{$blog->links();}}



{{-- Soft Delete Data --}}


<a href="#" class="btn btn-danger my-5" > Trash Data </a>


<table class="table table-bordered border-danger">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($trashData as $key=>$blogs)
        <tr>
            <th scope="row">{{$key+1}}</th>
            <td>{{$blogs->title}}</td>
            <td>{{$blogs->description}}</td>
            <td>
                <img src="{{asset('uploads/blog/'.$blogs->image)}}" alt="No Image" width="70px" height="70px">
            </td>
            <td class="d-flex">
                <a href="{{route('blogs.restor',$blogs->id)}}" class="btn btn-success mx-2">Restor Data</a> 

                <form method="get" action="{{ route('blogs.pdestroy',$blogs->id)}}">
                                
                    @csrf
                   
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('are you sure permanent Delete')">Delete</button>
                    </form>
                
            </td>
        </tr>   
        @endforeach
       

    </tbody>
</table>


        </div>
    </div>
</div>

@endsection
