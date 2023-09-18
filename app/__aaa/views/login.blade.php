@extends('AAA::BaseView')
@section('head')
<style>
   .login-form {
   width: 375px;
   margin: 50px auto;
   }
   .login-form form {        
   margin-bottom: 15px;
   background: #F5EFE7;
   box-shadow: #D7C0AE;
   padding: 20px;
   }
   .login-form h2 {
   margin: 0 0 15px;
   }
   .form-control, .login-btn {
   border-radius: 2px;
   }
   .input-group-prepend .fa {
   font-size: 18px;
   }
   .login-btn {
   font-size: 15px;
   font-weight: bold;
   min-height: 40px;
   }
   .social-btn .btn {
   border: none;
   margin: 10px 3px 0;
   opacity: 1;
   }
   .social-btn .btn:hover {
   opacity: 0.9;
   }
   .social-btn .btn-secondary, .social-btn .btn-secondary:active {
   background: #507cc0 !important;
   }
   .social-btn .btn-info, .social-btn .btn-info:active {
   background: #64ccf1 !important;
   }
   .social-btn .btn-danger, .social-btn .btn-danger:active {
   background: #df4930 !important;
   }
   .or-seperator {
   margin-top: 20px;
   text-align: center;
   border-top: 1px solid #ccc;
   }
   .or-seperator i {
   padding: 0 10px;
   background: #f7f7f7;
   position: relative;
   top: -11px;
   z-index: 1;
   }   
</style>
@endsection
@section('content')
<div class="login-form">
   <form id="FormLogin" action="login()" method="post">
      @csrf
      <h2 class="text-center">Login</h2>
			<p class="" style="margin: 10px;"></p>
      <div class="form-group">
         <div class="input-group">
            <div class="input-group-prepend">
               <span class="input-group-text">
               <span class="fas fa-user-alt text-primary"></span>
               </span>                    
            </div>
            <input type="text" class="form-control" id="username" placeholder="Enter Username" required="required">				
         </div>
      </div>
			<p class="" style="margin: 10px;"></p>
      <div class="form-group">
         <div class="input-group">
            <div class="input-group-prepend">
               <span class="input-group-text">
               <i class="fa fa-lock text-primary"></i>
               </span>                    
            </div>
            <input type="password" class="form-control" id="password" placeholder="Enter Password" required="required">				
         </div>
      </div>
			<p class="" style="margin: 10px;"></p>
      <div class="form-group">
         <div class="input-group">
            <div class="input-group-prepend">
               <span class="input-group-text">
               <span class="fa fa-angle-double-down text-primary"></span>
               </span>                    
            </div>
            <input type="text" value={{$kdcab}} class="form-control" id="Cabang" placeholder="Enter Branch" required="required">				
         </div>
      </div>
			<p class="" style="margin: 10px;"></p>
      <div class="text-center social-btn">
         <a type="submit" id="loginxx" class="btn btn-secondary"><i class="fa fa-sign-in")></i>&nbsp; Login</a>
         <a href="<a href="javascript:window.close();opener.window.focus();" class="btn btn-danger"><i class="fa fa-ban"></i>&nbsp; Batal</a>
      </div>
			<p class="" style="margin: 18px;"></p>
   </form>
</div>
@endsection    
@section('script')
<script>
   let LogCount = 0;
   var uname = $("#username");
   var pwd = $("#password");
       
   $(document).ready(function(){

     $("#loginxx").click(function(e){
       e.preventDefault();
       if(!uname.val() || uname.val().length === 0) 
       {
           alert("Silahkan diketik nama anda !!!");
           uname.focus(); 
           return 0; 
       }
       if(!pwd.val() || pwd.val().length === 0)
       {
           alert("Silahkan diketik Password anda !!!");
           pwd.focus(); 
           return 0;
       };
       aa=log_Ajax();
       if (aa==0) {
           LogCount = LogCount+1;
           if (LogCount < 3) {
               uname.focus(); 
           }
           return 0; 
       };
     });
   });
   
   function log_Ajax() {
     var url = "{{url('login2')}}";
     var Result = 0;
	 if (LogCount>3) {
		uname.value='';  
		pwd.value='';  
		alert("Anda tidak berhak menggunakan aplikasi ini !!!");
		document.write('<BR><BR><BR><BR><BR><BR><H1><CENTER>Access denied</H1></CENTER>'); 
		document.write('<P><CENTER>You do not have permision to access this page.</CENTER>');
		document.write('<P><CENTER>Please conntact your Administrator to request access.</CENTER>');}
	 else {
		$.ajax({type:'POST', url:url,data:{name:uname.val(),password:pwd.val()},
		  success: function (data, statusText, xhr) {
			  Result=xhr.status;
			  if (Result==202 && data.data.name ==uname.val()) {
				window.location.href=url.replace('login2',"menu/?key="+data.data.id_rec);}
			  else {
				alert("ID atau Password anda salah !!!");
			  }
		    },
          error: function (xhr) {
            alert(xhr.statusText);
         }
      })
      return Result;
   }
 }

</script>
@endsection

