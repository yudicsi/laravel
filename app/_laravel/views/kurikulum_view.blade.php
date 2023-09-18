@extends('AAA::Mstr_View')
<script>

function matpel_table_do() {
  do_Matpels(window.kurikulum_id,window.matpel_id,1);
  edt_kurikulum(window.kurikulum_id);
}

function do_Matpels(kurikulum_id, matpel_id, add=0) {
  var Url=(add?"{{url('Matpel_add_kurikulum')}}":"{{url('Matpel_del_kurikulum')}}");
  $.ajax({
    type: "POST", 
    url: Url,
    data: {kurikulum_id: kurikulum_id, matpel_id: matpel_id},
    dataType: 'json',
    success: function(res) {
      window.ajar.oTable.fnDraw(false);}
  });
}

</script>


@include('AAA::brw_master',['tbl_sql'=>'matpel','fluid'=>1]);

@section('edit_data')
  $('#ajar_table').dataTable().fnClearTable();
  if (res.matpels.length>0) {$('#ajar_table').dataTable().fnAddData(res.matpels);}
@endsection

@section('BeforeReady');
window.{{$ViewName}}_KeyName="Tingkat";
window.matpel_KeyName="nama_matpel";

@include('AAA::script_master',['tbl_sql'=>'matpel','fluid'=>1]);

sessionStorage.setItem('matpel_table_do', 'matpel_table_do()');

window.ajar={tblName:'#ajar_table'};
window.ajar.Table = $(window.ajar.tblName).DataTable({
  dom: 'Bfrt<"bottom" ip><"clear">',
  ordering: false,
  info: true,
  keys: true,
  paging: true,  
  pageLength:5,
  searching: false,
  autoWidth: false,
  stateSave: true,
  columns: [
    {data: 'id',name: 'id'},  
    {data: 'nama_matpel',name: 'nama_matpel', "width": "220px"}, 
    {data: 'bobot',name: 'bobot'}, 
    {data: 'status',name: 'status'}], 
  order: [[0, 'desc']],
  columnDefs: [
    {target: 0,visible: false,searchable: false}, 
    {target: 1, className: 'dt-head-center'}, 
    {targets: [2, 3, 4],searchable: false,className: 'dt-center'},
    {target: 4,defaultContent: 
      '<button type="Cancel" class="btn btn-danger ajar_table_del" style="width: 85px;margin:5px" data-bs-dismiss="modal">Delete</button>'}
  ]
});
window.ajar.oTable = $(window.ajar.tblName).dataTable();

$(window.ajar.tblName).on('click','.ajar_table_del',function(){
  var data=window.ajar.Table.row($(this).closest("tr")).data(),ss;
  var ss = data["nama_matpel"];
  if (confirm("Hapus Data "+titleCase(ss)+" ?") == true) {
    do_Matpels(data["pivot"].kurikulum_id,data["pivot"].matpel_id);
    edt_{{$ViewName}}(data["pivot"].kurikulum_id);
  }
  return false;
});  

ajar.Table.on('key-focus', function ( e, datatable, cell ) {
  window.ajar_row=cell.index().row;
  var row=datatable.row(ajar_row);
  var data=row.data();
  window.ajar_id=data['id'];
  window.ajar_name=data[matpel_KeyName];
  $(ajar.Table.row(ajar_row).node()).addClass('selected');
});

ajar.Table.on('key-blur', function ( e, datatable, cell ) {
  $(ajar.Table.row(cell.index().row).node()).removeClass('selected');
});


/* make dialog top most */
$("#Dialog_matpel").appendTo("body");

@endsection

