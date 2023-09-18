columns: [
  {data: 'id',name: 'id'}, 
  {data: 'Nama',name: 'Nama'}, 
  {data: 'tambahan',name: 'tambahan',width: "5%"}, 
  {data: 'JJM',name: 'JJM',width: "5%"}, 
  {data: 'Total_JJM',name: 'Total_JJM',width: "5%"}, 
  {data: 'action',name: 'action',orderable: false}],
order: [[0, 'desc']],
columnDefs: [
  {target: 0,visible: false,searchable: false}, 
  {target: 1,className: 'dt-head-center'}, 
  {targets: [2, 3, 4, 5],className: 'dt-center'}, 
  {targets: [2, 3, 4]}, 
  {target: 5,searchable: false}]