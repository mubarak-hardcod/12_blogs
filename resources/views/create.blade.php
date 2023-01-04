@extends('head')
@section('content')
<main class="signup-form">
    <div class="cotainer mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h3 class="card-header text-center">Create User</h3>
                    <div class="card-body">
                        <form action="{{ route('custom_create') }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Name" id="name" class="form-control" name="name"
                                    required autofocus>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email_address" class="form-control"
                                    name="email" required autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" id="password" class="form-control"
                                    name="password" required>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="tel" placeholder="Phone Number" id="phone_number" class="form-control"
                                    name="phone_number" required>
                                @if ($errors->has('phone_number'))
                                <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="file" placeholder="profile_pic" id="profile_pic" class="form-control"
                                    name="profile_pic" required>
                                @if ($errors->has('profile_pic'))
                                <span class="text-danger">{{ $errors->first('profile_pic') }}</span>
                                @endif
                            </div>
                            
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-success ">Create</button>
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
