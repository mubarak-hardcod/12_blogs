<?php

namespace App\Http\Controllers;

use App\Models\posts;
use App\Models\categories;
use App\Models\tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class postController extends Controller
{

    public function index()
    {
        $datas = posts::all();
        foreach ($datas as $data) {
            $a = json_decode($data->tag_id);
        }

        return view('posts.index', compact('datas', 'a'));
    }


    public function create()
    {
        $datas = posts::all();
        $datas1 = categories::all();
        $datas2 = tag::all();
        return view('posts.create', compact('datas', 'datas1', 'datas2'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
            'slug' => 'required',
            'body' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);
      
        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $img = $request->image->move(public_path() . '/blog/images/', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $_posts = new posts();
        $_posts->title = $request->title;
        $_posts->subtitle = $request->subtitle;
        $_posts->slug =  $request->slug;
        $_posts->body =  $request->body;
        $category = $request->category_id;
        $_posts->category_id = json_encode($category);
        $tag = $request->tag_id;
        $_posts->tag_id = json_encode($tag);
        $_posts->status = $request->status;
        $_posts->image = $fileNameToStore;
        $_posts->save();
        return redirect("post_index")->withSuccess('You have created successfully');
    }


    public function show(posts $posts, $id)
    {
        $datas = posts::find($id);
        $datas1 = categories::all();
        $datas2 = tag::all();
        $a = json_decode($datas->tag_id);
        $b = json_decode($datas->category_id);


        
        return view('posts.show', compact('datas','datas1','datas2','a','b'));
    }

    public function edit(posts $posts, $id)
    {
        $datas = posts::find($id);
        $datas1 = categories::all();
        $datas2 = tag::all();
        $a = json_decode($datas->tag_id);
        $b = json_decode($datas->category_id);


        return view('posts.edit', compact('datas', 'datas1', 'datas2', 'a', 'b'));
    }

    public function update(Request $request, $id)
    {

        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'profile_pic' => 'image|mimes:png,jpg,jpeg',
        //     'phone_number' => 'required|numeric|digits:10',
        //   ]);
        if ($request->hasFile('image')) {

            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $img = $request->image->move(public_path() . '/blog/images/', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $_posts = posts::find($id);
        $_posts->title = $request->title;
        $_posts->subtitle = $request->subtitle;
        $_posts->slug =  $request->slug;
        $_posts->body =  $request->body;
        $category = $request->category_id;
        $_posts->category_id = json_encode($category);
        $tag = $request->tag_id;
        $_posts->tag_id = json_encode($tag);
        $_posts->status = $request->status;
       

        if ($request->hasFile('image')) {

            if ($_posts->image != 'no_image.png') {
                Storage::delete('blog/images/' . $_posts->image);
            }
            $_posts->image = $fileNameToStore;
        }
        $_posts->save();
        return redirect("post_index")->withSuccess('You have updated successfully');
    }


    public function destroy(posts $posts, $id)
    {
        $data = posts::find($id);
        $data->delete();
        return redirect(route("post_index"))->withSuccess('Deleted successfully');
    }
}
