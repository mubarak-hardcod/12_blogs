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

              return redirect("login")->withSuccess('You have signed-in');
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
