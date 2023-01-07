<?php

namespace App\Http\Controllers;

use App\Models\posts;
use App\Models\categories;
use App\Models\tag;

use Illuminate\Http\Request;

class postController extends Controller
{
   
    public function index()
    {
        $datas = posts::all();
        return view('posts.index',compact('datas'));
    }

  
    public function create()
    {        
        $datas = posts::all();
        $datas1 = categories::all();
        $datas2 = tag::all();
        return view('posts.create',compact('datas','datas1','datas2'));
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'subtitle' => 'required',
            'slug' => 'required',
            'body' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            ]);

        echo ($request->title);       
        echo ($request->subtitle);
        echo ($request->slug);
        echo ($request->body);
        echo ($request->image)."<br>";
        echo ($request->category_id); 
        echo ($request->tag_id);
        echo ($request->status);

        exit();
            if($request->hasFile('image'))
    {
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $img=$request->profile_pic->move(public_path().'/blog/images/',$fileNameToStore);
        
       
    } else
    {
        $fileNameToStore = 'noimage.jpg';
    }
    $_posts = new posts();
    $_posts->title = $request->title;
    $_posts->subtitle = $request->subtitle;
    $_posts->slug =  $request->slug;
    $_posts->body =  $request->body;
    $_posts->category_id = $request->category_id;
    $_posts->tag_id = $request->tag_id;
    $_posts->status = $request->status;
    $_posts->image = $fileNameToStore;
    $_posts->save();
    return redirect("user_index")->withSuccess('You have created successfully');
    }

    
    public function show(posts $posts)
    {
        //
    }

    public function edit(posts $posts)
    {
        //
    }

    public function update(Request $request, posts $posts)
    {
        //
    }

    
    public function destroy(posts $posts)
    {
        //
    }
}
