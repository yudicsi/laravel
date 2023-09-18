columns: [
  {data: 'id',name: 'id'}, 
  {data: 'nama',name: 'nama'}, 
  {data: 'keterangan',name: 'keterangan'}, 
  {data: 'status',name: 'status'}, 
  {data: 'action',name: 'action',orderable: false}],
order: [[0, 'desc']],
columnDefs: [
  {target: 0,visible: false,searchable: false}, 
  {targets: [1,2,3],className: 'dt-head-center'}, 
  {targets: [3],className: 'dt-center'}, 
  {target: 4,width: 120,searchable: false}]
