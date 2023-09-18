columns: [
  {data: 'id',name: 'id'}, 
  {data: 'Tingkat',name: 'Tingkat'}, 
  {data: 'jurusan',name: 'jurusan'}, 
  {data: 'action',name: 'action',orderable: false}],
order: [[0, 'desc']],
columnDefs: [
  {target: 0,visible: false,searchable: false}, 
  {target: 1,className: 'dt-head-center dt-center',width: 70}, 
  {target: 2,width: 400}, 
  {targets: [2, 3],className: 'dt-head-center'}, 
  {target: 3,className: 'dt-center',width: 120,searchable: false}]

