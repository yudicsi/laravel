@extends('AAA::Mstr_View',['blade'=>'PATERN::sales2_choice'])

@section('view_child');
	@include('AAA::brw_master',['blade'=>'STOCK::lang_choice',
	'ViewName'=>'supplier','head'=>'supplier','caller'=>'Form_sales2'])
@endsection

@section('BeforeReady');
	window.{{$ViewName}}_KeyName="Nama";
	window.supplier_KeyName="Nama";
	document.getElementById("CompanyX").click();
@endsection
