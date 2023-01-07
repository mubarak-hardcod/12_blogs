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
                    <h3 class="card-header text-center">Edit Tag</h3>
                    <div class="card-body">
                        <form action="{{ route('tag_update',$datas->id) }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                           
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Name" id="name" class="form-control" value="{{$datas->name}}" name="name"
                                    required autofocus>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Slug" id="email_address"  value="{{$datas->slug}}" class="form-control"
                                    name="slug" required autofocus>
                                @if ($errors->has('slug'))
                                <span class="text-danger">{{ $errors->first('slug') }}</span>
                                @endif
                            </div>
                        
                            
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-success ">Update</button>
                             <a class="btn btn-primary  " href="{{ url('tag_index/')}}" role="button" >Back </a>
                                
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
