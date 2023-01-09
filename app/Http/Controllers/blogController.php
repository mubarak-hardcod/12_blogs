<?php

namespace App\Http\Controllers;
use App\Models\posts;



use Illuminate\Http\Request;

class blogController extends Controller
{
  
    public function blog_main()
    {
        $posts = posts::where('status',1)->orderBy('created_at','DESC')->paginate(3);
        return view('blog.blog',compact('posts'));        
    }

    
    
    
        public function postslug(posts $postslug)
        {
       
     
            
            return view('blog.post', compact('postslug'));
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
