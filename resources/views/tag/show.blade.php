@extends('head')
@section('content')

<div class="container mt-4">
    <div class="row">
        <h3>Categories Detail</h3>
        
        <a class="btn btn-primary mb-3 " href="{{ url('tag_index/')}}" role="button" style="margin-left:80%;">Back </a>

        <table class="table table-bordered">
            <thead>               
            </thead>
            <tbody>
            
                <tr>
                    <td>id</td>
                    <td>{{$datas->id}}</td>                    
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{$datas->name}}</td>                    
                </tr>
                <tr>
                    <td>Slug</td>
                    <td>{{$datas->slug}}</td>                    
                </tr>             
                            
            </tbody>
        </table>
    </div>
</div>
@endsection
