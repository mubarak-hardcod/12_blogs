@extends('blog/app')

@section('bg-img',asset('blog/img/home-bg.jpg'))

@section('title','My Blog')

@section('subheading','Here is my blog')

@section('main-content')
<!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
        @foreach($posts as $post)

            <div class="post-preview">
              <a href="">
                <h3 class="post-title">
                  {{ $post->title }}

                </h3>
                <h4 class="post-subtitle">
                {{ $post->subtitle }}

                </h4>
              </a>
              <p class="post-meta">Posted by
                <a href="#">User</a>
            </div>
          @endforeach


          <hr>
          <!-- Pager -->
          <div class="clearfix">
          </div>
        </div>
      </div>
    </div>

    <hr>
@endsection