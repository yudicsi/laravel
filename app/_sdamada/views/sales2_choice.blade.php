@switch($choice)
	@case('th_1')
		<th width="101px"><input type="text" size="10"></th>
		<th width="180px" ww="50k"><input type="text" size="20"></th>
		<th width="101px"><input type="text" size="10"></th>
		<th></th>
	@break
	
	@case('th_2')
		<th brw='UserId'>User ID</th>
		<th brw='UserName:L'>Nama User</th>
		<th brw=':C'>KdSupl</th>
		<th brw='id:H'>ID</th>
	@break
	
	@case('form')
		<style>
			.input-group-prepend .fa {
				font-size: 38px;
			}
			
		</style>
		<div class="modal fade" id="Form_{{$ViewName}}" aria-hidden="true" style="height:85%">
			<div class="modal-dialog modal-sm-12">
				<div class="modal-content">
					<div class="modal-header">
						<center>
							<h4 class="modal-title" id="FrmTitle_{{$ViewName}}"></h4>
						</center>
					</div>
					<div class="modal-body">
						<form action="javascript:void(0)" id="{{$ViewName}}Form" onsubmit="return false;" name="{{$ViewName}}Form" class="form-horizontal" method="POST" enctype="multipart/form-data"> 
							<input hidden type="text" name="is_exist" id="is_exist" value="{{$IdKey}}:Master {{$head}} tersebut sudah ada, ok !!!">
							<div class="container">
								<p class="" style="margin: 10px;"></p>
								<div class="row">
									<div class="form-group col-sm-6"><input type="text" class="form-control" id="UserName" name="UserName" placeholder="Masukkan Nama User" maxlength="30"> </div>
									<div class="form-group col-sm-6"><input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email User" maxlength="80" style="text-transform: lowercase"> </div>
								</div>
								<p class="" style="margin: 10px;"></p>
								<div class="row">
									<div class="form-group col-sm-6"><input type="text" class="form-control" id="UserId" name="UserId" placeholder="Masukkan User Id" maxlength="25"> </div>
									<div class="form-group col-sm-6"><input type="Password" class="form-control" id="UserPassword" name="UserPassword" placeholder="Masukkan Password User" maxlength="25"> </div>
								</div>
								<p class="" style="margin: 15px;"></p>
								<div class="row">
									<div class="form-group col-sm-4">
										<div class="input-group mb-3"> 
											<span class="input-group-text"> 
												<span class="fa fa-angle-double-down" onClick="brw_mst('supplier','SUPPLIER','Form_{{$ViewName}}')"></span> 
											</span> 
											<input type="text" class="form-control" id="KdSupl" brw='Kode' name="KdSupl" placeholder="Kode" maxlength="20"> 
										</div>
									</div>
									<div class="form-group col-sm-8">
										<div class="input-group mb-3"> 
											<span class="input-group-text"> 
												<span class="fa fa-angle-double-down" onClick="brw_mst('supplier','SUPPLIER','Form_{{$ViewName}}')"></span> 
											</span> 
											<input type="NmSupl" class="form-control" id="NmSupl" brw='Nama' name="NmSupl" placeholder="Nama">
										</div>
									</div>
								</div>
								<p class="" style="margin: 3px;"></p>
								<div class="text-end col-sm-offset-2"> <button class="btn btn-primary" id="btn-save" style="width: 80px; margin:5px" data-dismiss="modal">Simpan</button> <button class="btn btn-danger" id="btn-cancel" onclick="tutup('Form_{{$ViewName}}')" style="width: 80px;margin:5px">Batal</button> </div>
							</div>
						</form>
					</div>
					<div class="border-0 modal-footer" style="display:none"></div>
				</div>
			</div>
		</div>
	@break
@endswitch
