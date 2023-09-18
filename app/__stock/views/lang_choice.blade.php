@switch($choice)
	@case('th_1')
		<th width="130px"><input idx=2 type="text" size="14" id="{{$ViewName}}src_Nama"></th>
		<th width="101px"><input idx=3 type="text" size="10" id="{{$ViewName}}src_Kode"></th>
		<th width="380px"><input idx=4 type="text" size="25"></th>
		<th width="120px"><input idx=5 type="text" size="13"></th>
		<th width="180px"><input idx=6 type="text" size="20"></th>
	@break
	
	@case('th_2')
		<th brw=':L'>Nama</th>
		<th brw>Kode</th>
		<th brw='Almt:L'>Alamat</th>
		<th brw>npwp</th>
		<th brw=':L'>Keterangan</th>
	@break
	
	@case('form')
		<style>
					#Form_{{$ViewName}} .modal-dialog {
						margin: 20px auto;
					}

			.card-header {
			outline: none;  
			background-color: rgb(242, 236, 236);
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

			{{--
			.grp {
			border:none;
			outline: none;
			padding:0;
			margin:0;
			text-align: center;
			background-color:white;
			}
			--}}
			/* Style the tab */
			.tab {
			border: 1px solid 7D6E83;
			background-color: #B0A4A4;
			}
			/* Style the buttons inside the tab */
			.tab button {
			background-color: inherit;
			float: left;
			border: none;
			outline: none;
			cursor: pointer;
			padding: 14px 16px;
			font-size: 17px;
			color: gray;
			}
			/* Change background color of buttons on hover */
			.tab button:hover {
			background-color: #FFAB73;
			}
			/* Create an active/current tablink class */
			.tab button.active {
			background-color: #E6B325;
			color: black;
			}
			/* Style the tab content */
			.tabcontent {
			display: none;
			padding: 6px 12px;
			border: 1px solid #ccc;
			border-top: none;
			background-color: #F8EDE3;
			}
		</style>
		<script>
			function openTab(evt, TabName) {
				var i, tabcontent, tablinks;
				tabcontent = document.getElementsByClassName("tabcontent");
				for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				}
				tablinks = document.getElementsByClassName("tablinks");
				for (i = 0; i < tablinks.length; i++) {
					tablinks[i].className = tablinks[i].className.replace(" active", "");
				}
				document.getElementById(TabName).style.display = "block";
				evt.currentTarget.className += " active";
			}
			
		</script>
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
							<input hidden type="text" name="is_exist" id="is_exist" 
								value="{{$IdKey}}:Master {{$head}} tersebut sudah ada, ok !!!">
							<div class="tab">
								<div class="row">
									<button class="tablinks" id="CompanyX" onclick="openTab(event, 'Company')"><B>Company</button>
									<button class="tablinks" id="PersonalX" onclick="openTab(event, 'Personal')">Personal</B></button>
								</div>
							</div>
							<div id="Company" class="tabcontent">
								<BR>
								<div class="row">
									<div class="col-sm-3 form-group">
										<input type="text" class="w-100" id="Kode" name="Kode" placeholder="Kode {{$head}}" maxlength="10">
									</div>
									<div class="col-sm-9 form-group">
										<input type="text" class="text-left w-100" id="Nama" name="Nama" placeholder="Nama {{$head}}" maxlength="100">
									</div>
								</div>
								<p class="" style="margin: 10px;"></p>
								<div class="row">
									<div class="col-sm-12 form-group">
										<textarea rows="2" style="height:100%;" class="text-left w-100" id="Alamat" name="Alamat" placeholder="Alamat {{$head}}"></textarea>
									</div>
								</div>
								<p class="" style="margin: 10px;"></p>
								<div class="row">
									<div class="col-sm-6 form-group">
										<input type="text" class="w-100" id="Kota" name="Kota" placeholder="Alamat Kota" maxlength="10">
									</div>
									<div class="col-sm-6 form-group">
										<input type="text" class="text-left w-100" id="KodePos" name="KodePos" placeholder="Alamat Kode Pos" maxlength="100">
									</div>
								</div>
								<p class="" style="margin: 10px;"></p>
								<div class="row">
									<div class="col-sm-6 form-group">
										<input type="text" class="w-100" id="Telp" name="Telp" placeholder="No. HP / WA" maxlength="10">
									</div>
									<div class="col-sm-6 form-group">
										<input type="text" class="text-left w-100" id="Fax" name="Fax" placeholder="No. Fax / Telp" maxlength="100">
									</div>
								</div>
								<p class="" style="margin: 10px;"></p>
								<div class="row">
									<div class="col-sm-12 form-group">
										<input type="text" class="text-left w-100" id="Npwp" name="Npwp" placeholder="No. Wajib Pajak (NPWP)" maxlength="100">
									</div>
								</div>
								<p class="" style="margin: 10px;"></p>
								<div class="row">
									<div class="col-sm-6 form-group">
										<input type="text" class="w-100" id="No_Rek" name="No_Rek" placeholder="No. Rekening Bank" maxlength="10">
									</div>
									<div class="col-sm-6 form-group">
										<input type="text" class="text-left w-100" id="Bank" name="Bank" placeholder="Nama Bank">
									</div>
								</div>
								<p class="" style="margin: 10px;"></p>
								<div class="row">
									<div class="col-sm-12 form-group">
										<textarea rows="2" style="height:100%;" class="text-left w-100" id="Keterangan" name="Keterangan" placeholder="Keterangan"></textarea>
									</div>
								</div>
							</div>
							<div id="Personal" class="tabcontent">
								<BR>
								<div class="row">
									<div class="col-sm-12 form-group">
										<input type="text" class="text-left w-100" id="Nama1" name="Nama1" placeholder="Nama Contact Person" maxlength="100">
									</div>
								</div>
								<p class="" style="margin: 10px;"></p>
								<div class="row">
									<div class="col-sm-12 form-group">
										<textarea rows="2" style="height:100%;" class="text-left w-100" id="Alamat1" name="Alamat1" placeholder="Alamat Rumah Contact Person"></textarea>
									</div>
								</div>
								<p class="" style="margin: 10px;"></p>
								<div class="row">
									<div class="col-sm-6 form-group">
										<input type="text" class="w-100" id="Kota1" name="Kota1" placeholder="Alamat Kota" maxlength="10">
									</div>
									<div class="col-sm-6 form-group">
										<input type="text" class="text-left w-100" id="KodePos1" name="KodePos1" placeholder="Alamat Kode Pos" maxlength="100">
									</div>
								</div>
								<p class="" style="margin: 10px;"></p>
								<div class="row">
									<div class="col-sm-6 form-group">
										<input type="text" class="w-100" id="Telp" name="Telp" placeholder="No. HP / WA" maxlength="10">
									</div>
									<div class="col-sm-6 form-group">
										<input type="text" class="text-left w-100" id="Fax" name="Fax" placeholder="No. Fax / Telp" maxlength="100">
									</div>
								</div>
							</div>
							<p class="" style="margin: 20px;"></p>
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
		