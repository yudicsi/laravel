<thead>
    <tr>
      <th>id</th>
      <th>Nama Customer</th>
      <th>alamat</th>
      <th>Tgl Lahir</th>
      <th>longitude</th>
      <th>latitude</th>
      <th>Keterangan</th>
      <th>Status</th>
      <th><a class="btn btn-primary" onClick="add_mst('{{$ViewName}}','{{$head}}')" href="javascript:void(0)">+ ADD</a></th>
    </tr>  
</thead>
 <tfoot>
  <tr>
  <th>id</th>
      <th>Nama Customer</th>
      <th>alamat</th>
      <th>Tgl Lahir</th>
      <th>longitude</th>
      <th>latitude</th>
      <th>Keterangan</th>
      <th>Status</th>
      @if ($fluid>0)
        <th><a class="btn btn-danger" href="javascript:void(0)">CLOSE</a></th>
      @else
        <th>Action</th>
      @endif
  </tr>
</tfoot>

