@extends('head')
@section('content')

<div class="container mt-4">
    <div class="row">
        <h3>User Detail</h3>
        
        <a class="btn btn-primary mb-3 " href="{{ url('user_index/')}}" role="button" style="margin-left:80%;">Back </a>

        <table class="table table-bordered">
            <thead>               
            </thead>
            <tbody>
            
                <tr>
                    <td>id</td>
                    <td>{{$users->id}}</td>                    
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{$users->name}}</td>                    
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{$users->email}}</td>                    
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td>{{$users->phone_number}}</td>                    
                </tr>
                <tr>
                    <td>Image</td>
                    <td><img src="{{url('blog/images/'.$users->profile_pic)}}" alt="" style="width: 50px;"></td>                    
                </tr>                
            </tbody>
        </table>
    </div>
</div>
@endsection
