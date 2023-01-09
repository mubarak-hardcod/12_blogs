<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


use View;
use Hash;
use Session;


class CustomeUserController extends Controller
{
 
  public function dashboard()
  {  
      
      return view('dash');
     
  }    public function index()
    {
      
        $users = User::all();
        return view('index',compact('users'));
       
   
        
    }   
    public function create()
    {
     
        $users = User::all();
        return view('create');        
      
    }   
   

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:6',
      'profile_pic' => 'required|image|mimes:png,jpg,jpeg',
      'phone_number' => 'required|numeric|digits:10',
    ]);

    if($request->hasFile(('profile_pic'))){
      $filenameWithExt = $request->file('profile_pic')->getClientOriginalName();
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      $extension = $request->file('profile_pic')->getClientOriginalExtension();
      $fileNameToStore = $filename.'_'.time().'.'.$extension;
      $img=$request->profile_pic->move(public_path().'/blog/images/',$fileNameToStore);
    }
    else
    {
        $fileNameToStore = 'noimage.jpg';
    }
    $_users = new User;
    $_users->name = $request->name;
    $_users->email = $request->email;
    $_users->password = Hash::make( $request->password);
    $_users->phone_number = $request->phone_number;
    $_users->profile_pic = $fileNameToStore;
    $_users->save();
    return redirect("user_index")->withSuccess('You have created successfully');

  }  
  
    public function show($id)
    {     
        $users = User::findOrFail($id);
        return view('show',compact('users'));      
    } 
    public function edit($id)   {
      
        $users = User::findOrFail($id);
        return view('edit',compact('users'));       
         
    }    
      public function update(Request $request, $id)
  {

    $request->validate([
      'name' => 'required',
      'email' => 'required|email',
      'profile_pic' => 'image|mimes:png,jpg,jpeg',
      'phone_number' => 'required|numeric|digits:10',
    ]);
    if($request->hasFile('profile_pic'))
    {
        $filenameWithExt = $request->file('profile_pic')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('profile_pic')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $img=$request->profile_pic->move(public_path().'/blog/images/',$fileNameToStore);
        
       
    } else
    {
        $fileNameToStore = 'noimage.jpg';
    }
    $_users = User::find($id);
    $_users->name = $request->name;
    $_users->email = $request->email;    
    $_users->phone_number = $request->phone_number;
   

    if($request->hasFile('profile_pic'))
        {
            // Delete the old image if it's changed .
            if ($_users->profile_pic != 'no_image.png') 
            {
                Storage::delete('blog/images/'.$_users->profile_pic);
            }
            $_users->profile_pic = $fileNameToStore;
        }
      $_users->save();
      return redirect("user_index")->withSuccess('You have updated successfully');
  }  

    public function destroy($id)
    {
      $data = User::find($id);
      if ($data->profile_pic != 'no_image.png') 
            {
                Storage::delete('blog/images/'.$data->profile_pic);
            }
      $data->delete();     
      return redirect(route("user_index"))->withSuccess('Deleted successfully');
    }
}
