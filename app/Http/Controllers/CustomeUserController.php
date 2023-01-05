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

    
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6',
    //         'profile_pic'=>'required|image|mimes:png,jpg,jpeg',
    //         'phone_number'=>'required|numeric|digits:10',
    //     ]);     



    //     $imageName =$request->profile_pic->getClientOriginalName();                                                                                                                                                                                               
                   
    //     $img=$request->profile_pic->move(public_path().'/blog/images/',$imageName);           
    //     $data = $request->all();        
    //     $check = $this->createuser($data);      
         
    //   return redirect("user_index")->withSuccess('You have created successfully');
    // }

// public function createuser(array $data )
    // {
    //   return User::create([
    //     'name' => $data['name'],
    //     'email' => $data['email'],
    //     'password' => Hash::make($data['password']),  
    //     'profile_pic' => $data['profile_pic']->getClientOriginalName(),      
    //     'phone_number' => $data['phone_number'], 

    //   ]);
       
    // }   

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
    // public function update(Request $request, $id)    {
    
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email',           
    //         'profile_pic'=>'required|image|mimes:png,jpg,jpeg',
    //         'phone_number'=>'required|numeric|digits:10',
    //     ]);     
        
    //     $imageName =$request->profile_pic->getClientOriginalName();                                                                                                                                                                                                   
                   
    //     $img=$request->profile_pic->move(public_path().'/blog/images/',$imageName);           
    //     $data = $request->all();        
    //     $check = $this->createus($data,$id);      
         
    //   return redirect("user_index")->withSuccess('You have updated successfully');
    // }
    // public function createus(array $data,$id )
    // {
    //   return User::whereId($id)->update([
    //     'name' => $data['name'],
    //     'email' => $data['email'],       
    //     'profile_pic' => $data['profile_pic']->getClientOriginalName(),      
    //     'phone_number' => $data['phone_number'], 

    //   ]);
       
    // }    

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
        
        // $path = $request->file('profile_pic')->storeAs(public_path().'/blog/images/', $fileNameToStore);
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
