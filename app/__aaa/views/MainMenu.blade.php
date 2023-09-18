@extends('AAA::BaseView')
@section('head')
@if (!empty($_SESSION['ID_REQ']))  
<meta name="req_ID" content="{{$_SESSION['ID_REQ']}}">
<meta name="address" content="{{url()->current()}}">
@endif
<link rel="stylesheet" href="{{ asset('__aaa/css/MainMenu.css') }}">
<script src="{{ asset('__aaa/js/MainMenu.js') }}"></script>
@endsection
@section('content')
<header class="py-4 section-header">
   <div class="container">
      <h2>Demo page </h2>
   </div>
</header>
<!-- section-header.// -->
<div class="container">
   <!-- ============= COMPONENT ============== -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container-fluid">
         <a class="navbar-brand" href="#">{{$_SESSION['APP_COMPANY']}}</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav ms-auto" id="menu_utama">
            </ul>
            <script>var arr= <?php echo $arr ?>;
         
         </script>
            <script src="{{ asset('__aaa/js/setmenu.js') }}"></script>
            <script>
               arr='onclick=\'javascript:doMenu("';
               Mnx=Mnx.replaceAll('href="##1',arr);
               Mnx=Mnx.replaceAll('##2"','")\'');
               document.getElementById("menu_utama").innerHTML = Mnx;
            </script>
         </div>
         <!-- navbar-collapse.// -->
      </div>
      <!-- container-fluid.// -->
   </nav>
   <!-- ============= COMPONENT END// ============== -->
   <section class="py-5 section-content">
      <h6>Demo for LARAVEL TEST on PT. DWI SELO GIRIMAS  </h6>
   </section>
</div>
<!-- container //  -->
  <button onclick="log_user()">Click me</button>


  <script>

  function doMenu(mn) {
     s=$('meta[name=req_ID]').attr('content'); 
     t=$('meta[name=address]').attr('content'); 
     t=t.replace('menu','');     
     window.location.replace(t+mn+"/?key="+s.substr(s.length-20)+'>>'+s.substr(0,s.indexOf('-')));
	}

   
</script>


@endsection

