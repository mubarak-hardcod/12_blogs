<!DOCTYPE html>
<html lang="en">

  <head>

    @include('blog/layouts/head')

  </head>

  <body>

    @include('blog/layouts/header')

      @section('main-content')

        @show

    @include('blog/layouts/footer')

  </body>

</html>
