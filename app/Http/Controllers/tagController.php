<?php

namespace App\Http\Controllers;

use App\Models\tag;
use Illuminate\Http\Request;

class tagController extends Controller
{
    
    public function index()
    {
        $datas = tag::all();
        return view('tag.index',compact('datas'));
       
    }   
    public function create()
    {        
        $datas = tag::all();
        return view('tag.create');    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',           
          ]);      
          $_tag = new tag();
          $_tag->name = $request->name;
          $_tag->slug = $request->slug;         
          $_tag->save();
          return redirect("tag_index")->withSuccess('You have created successfully');
    }    
    public function show($id)
    {
        $datas = tag::find($id);
        return view('tag.show',compact('datas'));
    }  
    public function edit(tag $tag,$id)
    {
        $datas = tag::findOrFail($id);
        return view('tag.edit',compact('datas')); 
    }   
    public function update(Request $request, tag $tag,$id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            
          ]);
          
          $_tag = tag::find($id);
          $_tag->name = $request->name;
          $_tag->slug = $request->slug;           
      
            $_tag->save();
            return redirect("tag_index")->withSuccess('You have updated successfully');
    }    public function destroy(tag $tag,$id)
    {
        $data = tag::find($id);       
        $data->delete();     
        return redirect(route("tag_index"))->withSuccess('Deleted successfully');
    }
}
