columns: [
   {data: 'id',name: 'id'}, 
   {data: 'nama_matpel',name: 'nama_matpel'}, 
   {data: 'status',name: 'status'}, 
   {data: 'bobot',name: 'bobot'}, 
   {data: 'warna',name: 'warna'}, 
   {data: 'action',name: 'action',orderable: false}],
order: [[0, 'desc']],
columnDefs: [
   {target: 0,visible: false,searchable: false}, 
   {target: 1,className: 'dt-head-center'}, 
   {targets: [2, 3, 4,5],className: 'dt-center'}, 
   {target: 3,width: 30}, 
   {target: 5,width: 120,searchable: false},
   @if ($fluid>0) 
      {target: 4,visible: false}
   @endif]
