<?php

namespace App\Http\Controllers;
use App\Models\posts;



use Illuminate\Http\Request;

class blogController extends Controller
{
  
    public function blog_main()
    {
        $posts = posts::all();
        return view('blog.blog',compact('posts'));
        
    }

    
    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
