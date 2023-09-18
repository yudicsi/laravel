@extends('AAA::Mstr_View')
<link rel="stylesheet" href="{{ asset('_laravel/js/guru_view.css') }}"> 

<script>

function matpel_table_do() {
  do_Matpels(window.guru_id,window.matpel_id,1);
  edt_guru(window.guru_id);
}

function do_Matpels(guru_id, matpel_id, add=0) {
  var Url=(add?"{{url('Matpel_add_guru')}}":"{{url('Matpel_del_guru')}}");
  $.ajax({
    type: "POST", 
    url: Url,
    data: {guru_id: guru_id, matpel_id: matpel_id},
    dataType: 'json',
    success: function(res) {
      window.ajar.oTable.fnDraw(false);
    }
  });
}

</script>


@include('AAA::brw_master',['tbl_sql'=>'matpel','fluid'=>1,'button'=>'blank_button']);

@section('edit_data')
  $('#ajar_table').dataTable().fnClearTable();
  if (res.matpels.length>0) {$('#ajar_table').dataTable().fnAddData(res.matpels);}
@endsection

@section('BeforeReady');
window.{{$ViewName}}_KeyName="Nama";
window.matpel_KeyName="nama_matpel";

@include('AAA::script_master',['tbl_sql'=>'matpel','fluid'=>1]);

sessionStorage.setItem('matpel_table_do', 'matpel_table_do()');

window.ajar={tblName:'#ajar_table'};
window.ajar.Table = $(window.ajar.tblName).DataTable({
  paging: false,
  ordering: false,
  keys: true,
  info: false,
  pageLength:3,
  searching: false,
  autoWidth: false,
  stateSave: true,
  columns: [
    {data: 'id',name: 'id'}, 
    {data: 'nama_matpel',name: 'nama_matpel',width: "40%"}, 
    {data: 'bobot',name: 'bobot',width: "5%"}, 
    {data: 'status',name: 'status',width: "30%"}], 
  order: [[0, 'desc']],
  columnDefs: [
    {target: 0,visible: false,searchable: false}, 
    {target: 1, className: 'dt-head-center'}, 
    {targets: [2, 3, 4],searchable: false,className: 'dt-center'},
    {target: 4,width: "25%",defaultContent: 
      '<button type="Cancel" class="btn btn-danger ajar_table_del" style="width: 90px;margin:5px" data-bs-dismiss="modal">Delete</button>'}
  ]
});
window.ajar.oTable = $(window.ajar.tblName).dataTable();

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

