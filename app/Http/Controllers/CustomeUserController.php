<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use View;
use Hash;
use Session;


class CustomeUserController extends Controller
{
  public function dashboard()
  {
    if(Auth::check()){
      
      return view('dash');
     
  }
  return redirect('login'); 
      
  }
    public function index()
    {
      if(Auth::check()){
        $users = User::all();
        return view('index',compact('users'));
       
    }
    return redirect('login'); 
        
    }

   
    public function create()
    {
      if(Auth::check()){
        $users = User::all();
        return view('create');
       
    }
    return redirect('login'); 
        
      
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'profile_pic'=>'required|image|mimes:png,jpg,jpeg',
            'phone_number'=>'required|numeric|digits:10',
        ]);     
        $imageName =$request->profile_pic->getClientOriginalName();                                                                                                                                                                                                   
                   
        $img=$request->profile_pic->move(public_path().'/blog/images/',$imageName);           
        $data = $request->all();        
        $check = $this->createuser($data);      
         
      return redirect("user_index")->withSuccess('You have created successfully');
    }
    public function createuser(array $data )
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),  
        'profile_pic' => $data['profile_pic']->getClientOriginalName(),      
        'phone_number' => $data['phone_number'], 

      ]);
       
    }    
  
    public function show($id)
    {

      if(Auth::check()){
        $users = User::findOrFail($id);
        return view('show',compact('users'));
       
    }
    return redirect('login'); 
       
    }

   
    public function edit($id)
    {
      if(Auth::check()){
        $users = User::findOrFail($id);
        return view('edit',compact('users'));
       
    }
    return redirect('login'); 
       
       
    }

    
    public function update(Request $request, $id)
    {
    // echo '<pre>';
    // print_r($request->all());
    // exit();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',           
            'profile_pic'=>'required|image|mimes:png,jpg,jpeg',
            'phone_number'=>'required|numeric|digits:10',
        ]);     
        
        $imageName =$request->profile_pic->getClientOriginalName();                                                                                                                                                                                                   
                   
        $img=$request->profile_pic->move(public_path().'/blog/images/',$imageName);           
        $data = $request->all();        
        $check = $this->createus($data,$id);      
         
      return redirect("user_index")->withSuccess('You have updated successfully');
    }
    public function createus(array $data,$id )
    {
      return User::whereId($id)->update([
        'name' => $data['name'],
        'email' => $data['email'],       
        'profile_pic' => $data['profile_pic']->getClientOriginalName(),      
        'phone_number' => $data['phone_number'], 

      ]);
       
    }    

    public function destroy($id)
    {
      $data = User::findOrFail($id);
      // echo "<pre>";    print_r($data);exit();

      $data->delete();
      return 1;
      // return redirect("user_index")->withSuccess('Deleted successfully');
    }
}
