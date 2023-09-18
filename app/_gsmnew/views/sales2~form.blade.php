<div class="modal fade" id="Form_{{$ViewName}}" aria-hidden="true" style="height:85%">
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
        <div class="container">
          <div class="form-group">
            <label for="UserName" class="font-weight-bold control-label">Nama User</label>
            <input type="text" class="form-control" id="UserName" name="UserName" placeholder="Masukkan Nama User" maxlength="30">
          </div>
		  
          <div class="form-row">
            <div class="form-group col-sm-2">
              <label for="KdSupl" class="control-label font-weight-bold">Kode Supplier</label>
              <input type="text" class="form-control" id="KdSupl" name="KdSupl" placeholder="Kode Supplier" maxlength="20">
            </div>
            <div class="form-group col-sm-10">
              <label for="NmSupl" class="control-label font-weight-bold">Nama Suplier</label>
              <input type="NmSupl" class="form-control" id="NmSupl" name="NmSupl" placeholder="Nama Supplier">
            </div>
          </div>
		  
          
          <div class="form-row">
            <div class="form-group col-sm-6">
              <label for="UserId" class="control-label font-weight-bold">User ID</label>
              <input type="text" class="form-control" id="UserId" name="UserId" placeholder="Masukkan User Id" maxlength="25">
            </div>
            <div class="form-group col-sm-6">
              <label for="UserPassword" class="control-label font-weight-bold">Password User</label>
              <input type="Password" class="form-control" id="UserPassword" name="UserPassword" placeholder="Masukkan Password User" maxlength="25" >
            </div>
          </div>
		  
          <div class="form-row">
            <div class="form-group col-sm-10">
              <label for="email" class="control-label font-weight-bold">e-Mail</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email User" maxlength="80" 
			  style="text-transform: lowercase">
            </div>
            <div class="form-group col-sm-2">
              <label for="UserLevel" class="control-label font-weight-bold">Level</label>
              <input type="text" class="form-control" id="UserLevel" name="UserLevel" placeholder="Level" maxlength="3">
            </div>
          </div>
		  
          <div class="text-right col-sm-offset-2">
            <button class="btn btn-primary" id="btn-save" style="width: 80px; margin:5px" data-bs-dismiss="modal">Simpan</button>
            <button class="btn btn-danger" id="btn-cancel" onclick="tutup('Form_{{$ViewName}}')" style="width: 80px;margin:5px">Batal</button>
          </div>          
        </div>
      </form>
      </div>
      <div class="border-0 modal-footer" style="display:none"></div>        
    </div>
  </div>
</div>
