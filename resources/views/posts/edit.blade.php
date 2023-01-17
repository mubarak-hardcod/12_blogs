@extends('head')
@section('content')
<main class="signup-form">
    <div class="cotainer mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h3 class="card-header text-center">Edit Post</h3>
                    <div class="card-body">
                        <form action="{{ route('post_update',$datas->id) }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Title" id="title" class="form-control" name="title" value="{{$datas->title}}"
                                    required autofocus>
                                @if ($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Subtitle" id="subtitle" class="form-control"
                                    name="subtitle" value="{{$datas->subtitle}}" required autofocus>
                                @if ($errors->has('subtitle'))
                                <span class="text-danger">{{ $errors->first('subtitle') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Slug" id="slug" class="form-control"
                                    name="slug" value="{{$datas->slug}}"required>
                                @if ($errors->has('slug'))
                                <span class="text-danger">{{ $errors->first('slug') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                              <textarea name="body">{{$datas->body}}</textarea>
                                @if ($errors->has('body'))
                                <span class="text-danger">{{ $errors->first('body') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="file" placeholder="Image" id="image" class="form-control"
                                    name="image" >{{$datas->image}}
                                @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                            
                            <div class="form-group mb-3">
                                <label>Select Tags</label>
                                <select class="form-control select2" multiple="" data-placeholder="Select a Tag" style="width: 100%;" tabindex="-1" aria-hidden="true" name="tag_id[]">
                                @foreach ($datas2 as $tag)
                               
                                  <option value="{{ $tag->id }}"  @foreach ($a as $tag1) @if ($tag->id == $tag1) selected  @endif  @endforeach>{{ $tag->name }}</option>
                                  
                                @endforeach
                                </select>
                              </div>
                              <div class="form-group mb-3">
                                <label>Select Category</label>
                                <select class="form-control select2" multiple="" data-placeholder="Select a category" style="width: 100%;" tabindex="-1" aria-hidden="true" name="category_id[]">
                                  @foreach ($datas1 as $category)
                                    <option value="{{ $category->id }}"  @foreach ($b as $cat) @if ($category->id == $cat) selected  @endif  @endforeach>{{ $category->name }}</option>
                                  @endforeach
                                </select>
                              </div>      
                            <label>
                                    <input type="checkbox" name="status" value="1" @if ($datas->status == 1)
                        {{'checked'}}
                      @endif> Publish
                                  </label>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-success ">Create</button>
                             <a class="btn btn-primary  " href="{{ url('post_index/')}}" role="button" >Back </a>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
