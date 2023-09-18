<!DOCTYPE html>
<html lang="en">
<head>

<style>
  
  .table td,
  .table th {
    padding: 0%;
    margin:0%;
    border:0%;
    vertical-align: middle;
    border-top: 1px solid #b2d6b0;}

  table.dataTable thead tr {
    background-color: olive;
    color: white;}

  .table thead th {
    vertical-align: middle;
    border-bottom: 2px solid #dee2e6;}

    
  .delete_ {font-weight: bold; color: #641e16 ;background-color: #ebdcd9}
  .edit_ {font-weight: bold; color: #14476e ;background-color: #eaf2f8}
  .add_ {font-weight: bold; color: #14476e ;background-color: #113217}
  .change_ {font-weight: bold; color: #06038D }


</style>
@include('AAA::header')
<link href="https://cdn.datatables.net/select/1.2.1/css/select.dataTables.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.datatables.net/select/1.2.1/js/dataTables.select.min.js" type="text/javascript" ></script>

<link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js" type="text/javascript"></script>
  eta charset=utf-8 />

<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>  
</head>
<body>
    <div class="container mt-3">
      <div class="row">
        <div class="col-sm-12 margin-tb">
          <center>
            <h4>{{nama']}}</h4>
          </center>
        </div>
      </div>

      <div class="col-sm-12">
        <table class="table table-bordered compact sm-8 hover stripe display nowrap" style="width:100%">
          <TR>
            <TD width="27%"><B>No. PO</B></TD>
            <TD width="75%" id="no_po"></TD>
        </table>
        <table  class="table table-bordered compact sm-8 hover stripe display nowrap" style="width:100%" id="{{$ViewName}}_table">
          <thead>
            <tr>
            <th colspan="2" style="text-align:center;">ORDER</th>
            <th colspan="2" style="text-align:center;">SALDO</th>
            <th rowspan="2" style="vertical-align: middle;align: center">No</th>
			      <th rowspan="2" style="vertical-align: middle;">Kode</th>
            <th rowspan="2" style="vertical-align: middle;">Nama Stock</th>
            <th rowspan="2" style="vertical-align: middle;">Satuan</th>
            <th rowspan="2" style="vertical-align: middle;">Subtotal</th>
            <th rowspan="2" style="vertical-align: middle;">Nama Group</th>
            </tr>
            <tr>
              <th>QTY</th>
              <th>@</th>
              <th>QTY</th>
              <th>@</th>
            </tr>
          </thead>
          <tfoot>
            <tr id="filterboxrow">
              <th colspan="4"><a class="btn btn-danger" onclick="javascript:window.open('','_self').close();" href="javascript:void(0)">X Close</a></th>
              <th>No</th>
              <th>Kode</th>
              <th>Nama Stock</th>
              <th>Satuan</th>
              <th>Subtotal</th>
              <th>Nama Group</th>
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

<script type="text/javascript">
  window.{{$ViewName}}_KeyName="Urut";
  window.{{$ViewName}}_NotKey="1";
  window.{{$ViewName}}_Urut="";


$(document).ready(function() {
    aa=localStorage.getItem("id")+' / '+date_ind(localStorage.getItem("Tanggal"));
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    @include('AAA::script_master',['tbl_sql'=>$ViewName,'notsearch'=>1])
    $("#no_po").text(aa);
});



</script>
<script src="<?php echo asset('__aaa/js/Mstr_View.js') ?>"></script>
