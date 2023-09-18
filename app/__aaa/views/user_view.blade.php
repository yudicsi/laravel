@extends('AAA::Mstr_View',['blade'=>'AAA::user_choice'])

@section('BeforeReady');
	window.{{$ViewName}}_KeyName="UserId";
@endsection
