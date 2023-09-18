<!DOCTYPE html>
<html lang="en">

	<head>
		@include('AAA::header')
		<link rel="stylesheet" href="<?php echo asset('__aaa/css/Mstr_View.css') ?>"> 
	</head>

	<body style="background-color:#C6DCE4;">
			<div class="container mt-3">
			<div class="row">
				<div class="col-sm-12 margin-tb">
						<center><h2>{{ 'MASTER '.strtoupper($head) }}</h2></center>
				</div>   
			</div>
			@if ($message = Session::get('success'))
			<div class="alert alert-success">
				<p>{{ $message }}</p>
			</div>
			@endif
			
			<div class="card-body container-fluid sm-12">
				<table id="{{$ViewName}}_table" name="{{$ViewName}}_table" class="table table-bordered compact sm-12 hover stripe display" "style=width:100%" head="{{$head}}" fluid=0>
					<thead>
						<tr>
							<th width="84" colspan='2'><center><a class="btn btn-primary {{$ViewName}}_add fa-solid fa-plus" href="javascript:void(0)"> Add </center></a></th>    
							@include($blade,['choice'=>'th_1'])
							<th width="101px"><input type="text" size="10"></th>
							<th width="101px"><input type="text" size="10"></th>
							<th width="101px"><input type="text" size="10"></th>
							<th width="101px"><input type="text" size="10"></th>
						</tr>
						<tr>
							<th width="40px"><a class="btn btn-secondary {{$ViewName}}_refresh fas fa-sync" href="javascript:void(0)"></a></th>    
							<th width="40px"><a class="btn btn-warning text-primary fa fa-times" href="javascript:GotoAddr('/menu')"></a></th>
							@include($blade,['choice'=>'th_2'])
							<th width="101px">UserAdd</th>
							<th width="101px">DateAdd</th>
							<th width="101px" ww="40">UserEdit</th>
							<th width="101px" ww="40">DateEdit</th>
						</tr>
					</thead>
				</table>
			</div>
			@include($blade,['choice'=>'form'])
		</div>
		@yield('view_child');
	</body>
</html>

<script src="<?php echo asset('__aaa/js/Mstr_View.js') ?>"></script>
<script type="text/javascript">
window.{{$ViewName}}_ArrKey=[<?php echo $ArrKey?>];
window.{{$ViewName}}_KeyName="";
window.{{$ViewName}}_tblName='<?php echo $ViewName?>';


	
	
$(document).ready(function() {
  @yield('BeforeReady');
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

  @yield('AfterReady');
	OnReadyDoc();
});

</script>
