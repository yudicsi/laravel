@extends('AAA::Mstr_View')
<script src="{{ asset('_aaa/js/Mstr_View.js') }}"></script>

@section('edit_data')
  $('#id').val(res.id);
  $('#nama').val(res.nama);
  $('#keterangan').val(res.keterangan);
  $('#status').val(res.status);
@endsection

@section('BeforeReady');
window.{{$ViewName}}_KeyName="nama";
@endsection

