@extends('head')
@section('content')
<main class="signup-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                @if(session('success'))
                    <div class="alert alert-info">
                        <h3>{{session('success')}}</h3>
                    </div>
                    @endif
                    <h3 class="card-header text-center">Edit User</h3>
                    <div class="card-body">
                        <form action="{{ route('user_update',$users->id) }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                           
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Name" id="name" class="form-control" value="{{$users->name}}" name="name"
                                    required autofocus>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email_address"  value="{{$users->email}}" class="form-control"
                                    name="email" required autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                           
                            <div class="form-group mb-3">
                                <input type="tel" placeholder="Phone Number" id="phone_number"  value="{{$users->phone_number}}"class="form-control"
                                    name="phone_number" required>
                                @if ($errors->has('phone_number'))
                                <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <div><img src="{{url('blog/images/'.$users->profile_pic)}}" alt="profile" style="width: 50px;height:50px;"></div>
                                <input type="file" id="profile_pic"  class="form-control"  name="profile_pic" >
                                @if ($errors->has('profile_pic'))
                                <span class="text-danger">{{ $errors->first('profile_pic') }}</span>
                                @endif
                            </div>
                            
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-success ">Update</button>
                             <a class="btn btn-primary  " href="{{ url('user_index/')}}" role="button" >Back </a>
                                
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
