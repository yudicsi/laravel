columns: [{
    data: 'id',name: 'id'}, 
    {data: 'nama_kelas',name: 'nama_kelas'}, 
    {data: 'jurusan',name: 'jurusan'}, 
    {data: 'jumlah_siswa',name: 'jumlah_siswa',width: "5%"}, 
    {data: 'action',name: 'action',orderable: false}],
  order: [[0, 'desc']],
  columnDefs: [
    {target: 0,visible: false,searchable: false}, 
    {target: 1,className: 'dt-head-center'}, 
    {targets: [2, 3, 4],className: 'dt-center'}, 
    {target: 3,width: 10}, 
    {target: 4,width: 120,searchable: false}]
  