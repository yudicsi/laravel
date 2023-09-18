<div class="modal fade" id="Form_{{$ViewName}}" aria-hidden="true" style="height:85%">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h4 class="modal-title" id="FrmTitle_{{$ViewName}}"></h4>
        </center>
      </div>
      @if (file_exists($_SESSION['APP_DIR'].'/views/'.$ViewName.'_Before.blade.php'))
          @include($dir_view.$ViewName.'_Before')  
      @endif          
      <div class="modal-body">
          <form action="javascript:void(0)" id="{{$ViewName}}Form" name="{{$ViewName}}Form" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id">
            @include($dir_view.$ViewName."_form")  
            @if (!file_exists($_SESSION['APP_DIR'].'/views/'.$ViewName.'_button.blade.php'))
            <div class="text-right col-sm-offset-2">
              <button class="btn btn-primary" id="btn-save" style="width: 80px; margin:5px" data-bs-dismiss="modal">Simpan</button>
              <button class="btn btn-danger" id="btn-cancel" onclick="tutup('Form_{{$ViewName}}')" style="width: 80px;margin:5px">Batal</button>
            </div>          
            @else
              @include($dir_view.$ViewName.'_button')  ;
            @endif          
          </form>
      </div>
      <div class="border-0 modal-footer" style="display:none"></div>        
    </div>
  </div>
</div>
