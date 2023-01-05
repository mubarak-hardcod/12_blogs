@extends('head')
@section('content')
<div class="container mt-3">
@if(session('success'))
                    <div class="alert alert-info">
                        <h5>{{session('success')}}</h5>
                    </div>
                    @endif
    <div class="row">
   
        <h3>User Manage</h3>

        <table id="example1" class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $data)
                <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->phone_number}}</td>
                    <td>  <img src="{{url('blog/images/'.$data->profile_pic)}}" alt="profile" style="width: 50px;height:50px;"></td>
                    <td><a href="{{ url('user_detail/'. $data->id)}}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ url('user_edit/'. $data->id)}}" class="btn btn-success btn-sm">Edit</a>
                        <form id="delete-form-{{ $data->id }}" method="post" action="{{ url('user_delete/'.$data->id) }}" style="display: none">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                      </form>
                        <button type="submit" name="delete" onclick=" if(confirm('Are you sure, You Want to delete this?'))
                          {
                            event.preventDefault();
                            document.getElementById('delete-form-{{ $data->id }}').submit();
                          }
                          else{
                            event.preventDefault();
                          }"  id='btn_delete' value="{{$data->id}}" class="btn btn-danger btn-sm">Delete</button>
                     
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<!-- <script>
$(document).ready(function(){
  $("#btn_delete").click(function(){
    
    $.ajax({
        url: "{{ url('user_delete')}}/" + $("#btn_delete").val(), 
        method: 'POST',
        data: {
            _token : "{{ csrf_token() }}"
        },
        success: function(result){
            if(result ==1){
                window.location.reload();            }
        
    }});
  });
});
</script> -->
@endsection