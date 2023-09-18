<!DOCTYPE HTML>
<html lang="en">
<head>
    @include('AAA::header')
    @yield('title')
    @yield('head')   
</head>
<body style="background-color:#C6DCE4;">
   @yield('content')    
</body>
@yield('script')
</html>
