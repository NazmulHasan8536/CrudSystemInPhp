<?php

namespace App\Http\Controllers;

use App\blogs;
use Illuminate\Http\Request;

class blogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $blogs = blogs::latest()->paginate(5);
      return view('blogs.index',compact('blogs'))
          ->with('i',(\request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        blogs::create($request->all());

        return redirect()->route('blogs.index')
            ->with('success','Blog created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function show(blogs $blog){
        return view('blogs.show',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function edit(blogs $blog)
    {
        return view('blogs.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, blogs $blog)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $blog->update($request->all());

        return redirect()->route('blogs.index')
            ->with('success','Blog created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function destroy(blogs $blog)
    {
        $blog->delete();

        return redirect()->route('blogs.index')
            ->with('success','Deleted successfully');
    }
}
