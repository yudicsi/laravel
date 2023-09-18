<!DOCTYPE HTML>
<html lang="en">
  <head>

    <style>
      table {
      margin: 0 auto;
      width: 100%;
      clear: both;
      border-collapse: collapse;
      table-layout: fixed; // ***********add this
      word-wrap:break-word; // ***********and this
      }

      .table td,
      .table th {
        padding: 1rem;
        vertical-align: middle;
        border-top: 1px solid #b2d6b0;}

      table.dataTable thead tr {
        background-color: olive;
        color: white;}

      .table thead th {
        vertical-align: middle;
        border-bottom: 2px solid #dee2e6;}

    </style>
    @include('AAA::header')
    </head>
    <body>
    <div class="container mt-3">
      <div class="row">
        <div class="col-sm-12 margin-tb">
          <center>
            <h4>ORDER BELI</h4>
          </center>
        </div>
      </div>
      <div class="col-sm-12">
        <table class="table table-bordered compact sm-8 hover stripe display nowrap" style="width:100%">
          <TR>
            <TD width="25%"><B>Supplier</B></TD>
            <TD width="75%">{{nama']}}</TD>
        </table>
        <table class="table table-bordered compact sm-8 hover stripe display nowrap" style="width:100%" id="{{$tbl_Name}}">
          <thead>
            <tr>
              <th>Action</th>
              <th>No. Nota</th>
              <th>Tanggal</th>
              </th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th><a class="btn btn-primary" onClick="#" href="javascript:void(0)">+ ADD</a></th>
              <th>No. Nota</th>
              <th>Tanggal</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="col-sm-2">
      </div>
    </div>
    </div>
    </body>
</html>
<script src="<?php echo asset('__aaa/js/Mstr_View.js') ?>"></script>
<script type="text/javascript">
  window.{{$ViewName}}_KeyName="id";
  window.{{$ViewName}}_tblName='<?php echo $tbl_Name?>';
  window.{{$ViewName}}_NotKey="1";


  $(document).ready(function() {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    @include('AAA::script_master',['tbl_sql'=>$ViewName,'notsearch'=>1])}
  );
  
  
</script>
