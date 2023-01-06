<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use View;
use Hash;
use Session;


class categoriesController extends Controller
{
    
    public function index()
    {
      
           
              $datas = categories::all();
              return view('categories.index',compact('datas'));
             
         
              
          
    }

  
    public function create()
    {
        
          $datas = categories::all();
          return view('categories.create');
         
    
        
      }

  
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
           
          ]);      
          
          $_categories = new categories();
          $_categories->name = $request->name;
          $_categories->slug = $request->slug;         
          $_categories->save();
          return redirect("categories_index")->withSuccess('You have created successfully');
    }

   
    public function show($id)
    {
      
              $datas = categories::find($id);
              return view('categories.show',compact('datas'));
             
       
       
             
        
    }

  
    public function edit(categories $categories,$id)
    {
      
            $datas = categories::findOrFail($id);
            return view('categories.edit',compact('datas'));       
      
    }

   
    public function update(Request $request, categories $categories, $id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            
          ]);
          
          $_users = categories::find($id);
          $_users->name = $request->name;
          $_users->slug = $request->slug;           
      
            $_users->save();
            return redirect("categories_index")->withSuccess('You have updated successfully');
    }

  
    public function destroy(categories $categories,$id)
    {
        $data = categories::find($id);       
        $data->delete();     
        return redirect(route("categories_index"))->withSuccess('Deleted successfully');
    }

   
}


