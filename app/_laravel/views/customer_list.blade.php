columns: [
  {data: 'id',name: 'id'}, 
  {data: 'nama',name: 'nama'}, 
  {data: 'alamat',name: 'alamat'}, 
  {data: 'tanggal_lahir',name: 'tanggal_lahir'}, 
  {data: 'longitude',name: 'longitude',width: "5%"}, 
  {data: 'latitude',name: 'latitude',width: "5%"}, 
  {data: 'keterangan',name: 'keterangan'}, 
  {data: 'status',name: 'status'}, 
  {data: 'action',name: 'action',orderable: false}],
order: [[0, 'desc']],
columnDefs: [
  {target: 0,visible: false,searchable: false}, 
  {targets: [1,2],className: 'dt-head-center'}, 
  {targets: [3, 4, 5],className: 'dt-center'}, 
  {targets: [6,7],visible: false,searchable: false}, 
  {target: 8,width: 140,searchable: false}]
