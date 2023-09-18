<thead>
    <tr>
          <th>id</th>
          <th>Nama Kelas</th>
          <th>Jurusan</th>
          <th>Jml Siswa</th>
          <th><a class="btn btn-primary" onClick="add_mst('{{$ViewName}}','{{$head}}')" href="javascript:void(0)">+ ADD</a></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>id</th>
          <th>Nama Kelas</th>
          <th>Jurusan</th>
          <th>Jml Siswa</th>
          @if ($fluid>0)
          <th><a class="btn btn-danger" href="javascript:void(0)">CLOSE</a></th>
          @else
          <th>Action</th>
          @endif
        </tr>
      </tfoot>
  