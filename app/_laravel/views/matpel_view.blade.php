@extends('AAA::Mstr_View')
@section('BeforeReady');
window.{{$ViewName}}_KeyName="nama_matpel";
window.{{$ViewName}}BeforeSave=function() {
    return true;
  }

  
@endsection
