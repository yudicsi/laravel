<div class="row">
    <div class="col-sm-10">
      <div class="form-group">
        <label for="Nama" class="col-sm-10 control-label">NAMA GURU</label>
        <input type="text" class="form-control" id="Nama" name="Nama" placeholder="Masukkan Nama Guru" maxlength="50">
      </div>
      <div class="card-columns">
        <div class="card centered d-flex">
          <div class="card-header">JAM TAMBAHAN</div>
          <div class="card-body d-flex">
            <input type="number" class="jam" id="tambahan" name="tambahan" placeholder="Ketik dengan Angka">
          </div>
        </div>
        <div class="card centered d-flex">
          <div class="card-header">JAM MENGAJAR</div>
          <div class="card-body d-flex">
            <input type="number" class="jam" id="JJM" name="JJM" placeholder="Ketik dengan Angka">
          </div>
        </div>
        <div class="card centered d-flex">
          <div class="card-header">TOTAL JAM</div>
          <div class="card-body d-flex">
            <input type="number" class="jam" id="Total_JJM" name="Total_JJM" placeholder="Ketik dengan Angka">
          </div>
        </div>
      </div>
      <div class="card centered" style=" height: 16rem;">
        <table class="table table-bordered compact hover stripe" style="width:100%" id="ajar_table">
          <thead>
            <tr>
              <th>id</th>
              <th>Nama Pelajaran</th>
              <th>Bobot</th>
              <th>Status</th>
              <th>
                <a class="btn btn-primary" onclick="brw_mst('matpel')">+ ADD</a>
              </th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <div class="text-center col-sm-2">
      <button type="submit" class="btn btn-primary" style="width: 80px; margin:5px" data-bs-dismiss="modal">Simpan</button>
      <button type="Cancel" class="btn btn-danger" onclick="tutup('Form_guru')" style="width: 80px;margin:5px">Batal</button>
    </div>
  </div>
  
  