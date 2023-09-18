@switch($choice)
	@case('th_1')
		<th width="130px"><input idx=2 type="text" size="14"></th>
		<th width="101px"><input idx=3 type="text" size="10"></th>
	@break
	
	@case('th_2')
		@if ($head == 'display')
			<th brw=':L'>Nama</th>
		@else
			<th brw=':L'>Keterangan</th>
		@endif
		<th brw>Kode</th>
	@break
	
	@case('form')
		<style>
					#Form_{{$ViewName}} .modal-dialog {
						margin: 50px auto;
					 background-color:#EADBC8;
					}
			.card-header {
			outline: none;  
			background-color:rgb(242, 236, 236);
			text-align: center;
			width:100%;
			font-weight: bold;
			}
			.card centered {
			padding:0;
			margin:0;
			}
			.card-body {
			height: 12px;
			align-items: center; 
			justify-content: center;
			pading:0;
			}
			.grp {
			border:none;
			outline: none;
			padding:0;
			margin:0;
			text-align: center;
			background-color:white;
			}
		</style>


		<div class="modal" id="Form_{{$ViewName}}" aria-hidden="true" style="height:100%">
			<div class="modal-dialog modal-sm-12">
				<div class="modal-content">
					<div class="modal-header">
						<center>
							<h4 class="modal-title" id="FrmTitle_{{$ViewName}}"></h4>
						</center>
					</div>
					<div class="modal-body">
						<form action="javascript:void(0)" id="{{$ViewName}}Form" name="{{$ViewName}}Form" class="form-horizontal" method="POST" enctype="multipart/form-data">
						
						@if ($head == 'display')
							<input hidden type="text" name="Kode" id="Kode">
							<div class="form-row">
								<div class="col-sm-12">
									<div class="card centered d-flex">
										<div class="card-header">NAMA DISPLAY</div>
										<div class="card-body d-flex">
											<input type="text" class="grp text-left w-100" id="Nama" name="Nama" placeholder="Masukkan Nama Display" maxlength="100">
										</div>
									</div>
								</div>
							</div>
						@else
							<input hidden type="text" name="is_exist" id="is_exist" value="{{$IdKey}}:Master {{$head}} tersebut sudah ada, ok !!!">
							<div class="row">
								<div class="col-sm-3">
									<div class="card centered d-flex">
										<div class="card-header">KODE</div>
										<div class="card-body d-flex">
											<input type="text" class="grp w-100" id="Kode" name="Kode" placeholder="Masukkan Kode" maxlength="10">
										</div>
									</div>
								</div>
								<div class="col-sm-9">
									<div class="card centered d-flex">
										<div class="card-header">KETERANGAN</div>
										<div class="card-body d-flex">
											<input type="text" class="grp text-left w-100" id="Keterangan" name="Keterangan" placeholder="Masukkan Keterangan" maxlength="100">
										</div>
									</div>
								</div>
							</div>
						@endif
						<BR>
						<div class="text-end col-sm-offset-2">
							<button class="btn btn-primary" id="btn-save" style="width: 80px; margin:5px" data-bs-dismiss="modal">Simpan</button>
							<button class="btn btn-danger" id="btn-cancel" onclick="tutup('Form_{{$ViewName}}')" style="width: 80px;margin:5px">Batal</button>
						</div>
						</form>
					</div>
					<div class="border-0 modal-footer" style="display:none"></div>
				</div>
			</div>
		</div>
	@break
@endswitch
	