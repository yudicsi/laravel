<thead>
    <tr>
       <th>id</th>
       <th>Mata Pelajaran</th>
       <th>Status</th>
       <th>Bobot</th>
       <th>Warna</th>
       @if ($fluid>0)
          <th>Action</th>
       @else
          <th><a class="btn btn-primary" onClick="add_mst('matpel','mata Pelajaran')" href="javascript:void(0)">+ ADD</a></th>
      @endif
        </tr>
</thead>
<tfoot>
    <tr>
       <th>id</th>
       <th>Mata Pelajaran</th>
       <th>Status</th>
       <th>Bobot</th>
       <th>Warna</th>
       @if ($fluid>0)
         <th><a class="btn btn-danger" id="matpel_table_close" onClick="tutup('Dialog_matpel','Form_guru')" href="javascript:void(0)">CLOSE</a></th>
       @else
         <th>Action</th>
       @endif
    </tr>
</tfoot>
 