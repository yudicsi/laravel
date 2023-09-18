@extends('AAA::Mstr_View',['blade'=>'STOCK::grup_choice'])

@section('BeforeReady');
	@if ($head == 'display')
		window.{{$ViewName}}_KeyName="Nama";
	@else
		 window.{{$ViewName}}_KeyName="Keterangan";
	@endif 
@endsection

