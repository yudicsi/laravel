<div class="row">
  <div class="col-sm-12">  
    <div class="form-group">
        <label for="nama" class="control-label">NAMA CUSTOMER</label>
        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama customer" maxlength="50">
      </div>  
      
    <div class="form-group">
    <label for="alamat" class="col-sm-12 control-label">ALAMAT CUSTOMER</label>
    <textarea rows="4" cols="50" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat customer" maxlength="50"></textarea> 
	</div>     
 </div>
      <div class="text-center col-sm-2">
        <button type="submit" class="btn btn-primary" style="width: 80px; margin:5px" data-bs-dismiss="modal">Simpan</button>
        <button type="Cancel" class="btn btn-danger" onclick="tutup('Form_guru')" style="width: 80px;margin:5px">Batal</button>
    </div>
    <div class="card-columns">
    <div class="card centered d-flex">
      <div class="card-header">TANGGAL LAHIR</div>
      <div class="card-body d-flex">
        <input type="date" class="kolom" id="tanggal_lahir" name="tanggal_lahir">
      </div>
      <div class="card centered d-flex">
      <div class="card-header">LONGITUDE</div>
      <div class="card-body d-flex">
        <input type="number" class="kolom" id="longitude" name="longitude" placeholder="Ketik dengan Angka">
      </div>

      <div class="card centered d-flex">
      <div class="card-header">LATITUDE</div>
      <div class="card-body d-flex">
        <input type="number" class="kolom" id="latitude" name="latitude" placeholder="Ketik dengan Angka">
      </div>
    </div>

    </div>



    </div>


    </div>

</div>  
