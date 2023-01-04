<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\blog\images;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }  
      
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('auth.registration');
    }
      
    public function customRegistration(Request $request)
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
        $check = $this->create($data);      
         
      return redirect("login")->withSuccess('You have signed-in');
    }

    public function create(array $data )
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),  
        'profile_pic' => $data['profile_pic']->getClientOriginalName(),      
        'phone_number' => $data['phone_number'], 

      ]);
       
    }    
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard'); 
        }
  
        return redirect("login")->withErrors('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login')->withErrors('You are sucessfully Log Out');
    }
}
