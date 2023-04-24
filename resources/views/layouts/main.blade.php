<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

@if (Auth::check())
<script>
       window.user = @json(auth()->user());
   
        window.user_roles = @json( auth() -> user()-> roles()->get());
  
    </script>
    <!-- <div>{{ auth() -> user()}}</div>
    <div>{{ auth() -> user()->roles()->get()[0]}}</div> -->
    @endif
    <div id="app"> 
        @yield('content')
    </div>
</body>
</html>