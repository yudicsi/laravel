columns: [
  {data: 'action',name: 'action',orderable: false},
  {data: 'id',name: 'id'}, 
  {data: null, name: 'tgl', render: function(data, type, row) {
    return date_ind(data.tgl);}}
  ],
order: [[1, 'desc']],
columnDefs: [
  {target: 1,width:"25%"},
  {target: 2,width:"25%"},
  {targets: [0, 1, 2],className: 'dt-center dt-head-center'}, 
  {target: 0,searchable: false, width:"25%"}]

