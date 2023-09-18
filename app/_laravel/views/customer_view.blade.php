@extends('AAA::Mstr_View')
<link rel="stylesheet" href="{{ asset('_laravel/css/customer_view.css') }}"> 
<script src="{{ asset('-aaa/js/Mstr_View.js') }}"></script>

@section('edit_data')
  $('#id').val(res.id);
  $('#nama').val(res.nama);
  $('#alamat').val(res.alamat);
  $('#tanggal_lahir').val(res.tanggal_lahir);
  $('#longitude').val(res.longitude);
  $('#keterangan').val(res.keterangan);
  $('#status').val(res.status);
@endsection

@section('BeforeReady');
window.{{$ViewName}}_KeyName="nama";
@endsection

