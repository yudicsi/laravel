@extends('AAA::Mstr_View',['blade'=>'STOCK::lang_choice'])

@section('BeforeReady');
	window.{{$ViewName}}_KeyName="Nama";
	document.getElementById("CompanyX").click();
@endsection
