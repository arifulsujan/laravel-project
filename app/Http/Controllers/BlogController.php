<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Blog::latest()->simplepaginate(5);

        $trashData = Blog::onlyTrashed()->latest()->paginate(10);
        return view('pages.index',compact('blog','trashData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required',
            'description'=> 'required',
            'image'=> 'required | image ',
        ],[
            'title.required'=>'Title Must be Included',
            'description.required'=>'Title Must be Included',
            'image.image'=>'Upload Must Image Type',
        ]);  
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;
       if ($request->hasFile('image')) {
           $file = $request->file('image');
           $extension = $file->getClientOriginalExtension();
            $filename = time().' '.$extension;
            $file->move('uploads/blog',$filename);
            $blog->image = $filename;
       }
       $blog->save();

       return redirect('blogs')->with('msg','Blog Post Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
       $blog = Blog::find($id);
        return view('pages.single_post',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('pages.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=> 'required',
            'description'=> 'required',
            'image'=> 'required | image ',
        ],[
            'title.required'=>'Title Must be Included',
            'description.required'=>'Title Must be Included',
            'image.image'=>'Upload Must Image Type',
        ]);  
        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->description = $request->description;
       if ($request->hasFile('image')) {

           $file = $request->file('image');
           $extension = $file->getClientOriginalExtension();
            $filename = time().' '.$extension;
            $file->move('uploads/blog',$filename);
            $blog->image = $filename;
       }
       $blog->update();

       return redirect('blogs')->with('msg','Blog Post Updated Successfully');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return redirect('blogs')->with('msg','Blog Post Deleted Successfully');
    }


    public function restor($id){

        Blog::withTrashed()->find($id)->restore();
        return redirect('blogs')->with('msg','Blog Post ReStored Successfully');
    }



    public function pdestroy($id){

        Blog::onlyTrashed()->find($id)->forceDelete();
        
        return redirect('blogs')->with('msg','Blog Post Deleted Successfully');
    }


}
