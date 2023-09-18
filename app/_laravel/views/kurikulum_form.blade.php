

<style>
.jurusan {
  border:none;
  outline: none;
  padding:0;
  margin:0;
  background-color:white;
}
.tblx {
padding:0;
margin:0;
text-align: center;
vertical-align: middle;
width:100%;
}

table.tblx thead tr {
  background-color: rgb(148, 148, 140);
  color: white;}

  .modal-dialog {
  width: 850px;
  height:1400px !important;
}

</style>

<script>
  
  window.{{$ViewName}}BeforeSave=function () {
    if (isEmpty('Tingkat','Kelas / Tingkat harus diisi dulu, ok !!!') || isEmpty('jurusan','Jurusan / peminatan harus diisi dulu, ok !!!')) {
       return false;
     }
     return true;
  }

  function AddMatpel() {
    var ss=sessionStorage.getItem("Form_{{$ViewName}}");
    if (ss=='add') {
       if (!{{$ViewName}}BeforeSave()) {
          return false;
        }
    }
    brw_mst('matpel');
  }

     
</script>

<div class="row">
  <input type="hidden" name="is_exist" id="is_exist" 
  value="Tingkat,jurusan:Master Kurikulum u/ Kelas dan peminatan tersebut sudah ada, ok !!!">
    
  <div class="col-sm-10">

    <table class="table" style="width:100%;margin:0;padding:0">  
      <tr>
        <td style="width:10%;margin:0;padding:0;padding-bottom:2%">

        <table class="table tblx table-bordered">  
          <thead>
            <tr>
              <th class="p-2">No. Faktur</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="p-2"><input class="text-center jurusan" type="number" id="Tingkat" name="Tingkat"></td>
            </tr>
          </tbody>   
        </table>
        </td>

        <td style="margin:0;padding:0;padding-bottom:2%;padding-left:2%">
        <table class="table tblx table-bordered">  
          <thead>
            <tr>
              <th class="p-2">JURUSAN / PEMINATAN</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="p-2"><input type="text"  class="text-left jurusan" style="width: 100%" id="jurusan" name="jurusan"></td>
            </tr>
          </tbody>   
        </table>
        </td>
      </tr>  
    </table>
  
    <div class="card centered" style=" height: 16rem;">
        <table class="table table-bordered compact hover stripe" style="width:100%" id="ajar_table">
          <thead>
            <tr>
              <th>id</th>
              <th>Nama Pelajaran</th>
              <th>Bobot</th>
              <th>Status</th>
              <th>
                <a class="btn btn-primary" onclick="AddMatpel()">+ ADD</a>
              </th>
            </tr>
          </thead>
        </table>
      </div>
      
    </div>
    <div class="text-center col-sm-2">
      <button type="submit" class="btn btn-primary" style="width: 80px; margin:5px" data-bs-dismiss="modal">Simpan</button>
      <button type="Cancel" class="btn btn-danger" onclick="tutup('Form_kurikulum')" style="width: 80px;margin:5px">Batal</button>
    </div>
  </div>
  
  
      