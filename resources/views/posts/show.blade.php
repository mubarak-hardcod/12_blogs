@extends('head')
@section('content')

<div class="container mt-4">
    <div class="row">
        <h3>Post Detail</h3>
        
        <a class="btn btn-primary mb-3 " href="{{ url('post_index/')}}" role="button" style="margin-left:80%;">Back </a>

        <table class="table table-bordered">
            <thead>               
            </thead>
            <tbody>
            
                <tr>
                    <td>Id</td>
                    <td>{{$datas->id}}</td>                    
                </tr>
                <tr>
                    <td>Title</td>
                    <td>{{$datas->title}}</td>                    
                </tr>
                <tr>
                    <td>Subtitle</td>
                    <td>{{$datas->subtitle}}</td>                    
                </tr>
                <tr>
                    <td>Slug</td>
                    <td>{{$datas->slug}}</td>                    
                </tr>
                <tr>
                    <td>Body</td>
                    <td>{{$datas->body}}</td>                    
                </tr>                            
                <tr>
                    <td>Image</td>
                    <td><img src="{{url('blog/images/'.$datas->image )}}" alt="" style="width: 70px;"></td>                    
                </tr>   
                <tr>
                    <td>Status</td>
                    <td>{{$datas->status}}</td>                    
                </tr>
                <tr>
                    <td>Created at</td>
                    <td>{{$datas->created_at}}</td>                    
                </tr>
                <tr>
                    <td>Updated at</td>
                    <td>{{$datas->updated_at}}</td>                    
                </tr>             
            </tbody>
        </table>
    </div>
</div>
@endsection
