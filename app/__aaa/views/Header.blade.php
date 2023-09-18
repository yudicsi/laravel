  <!doctype html>
  <html lang="en">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (env('APP_ONLINE'))  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
		<script src="https://kit.fontawesome.com/960a5a11f9.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/keytable/2.7.0/js/dataTables.keyTable.min.js"></script>
  @else
    <link href="{{ asset('bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet"> 
    <link href="{{ asset('DataTables/DataTables-1.13.6/css/jquery.dataTables.min.css') }}" rel="stylesheet">
		<link href="{{ asset('fontawesome-free-6.4.2-web/css/all.min.css') }}" rel="stylesheet" > 
    <script src="{{ asset('jquery3.7/jquery370.min.js') }}"></script>
    <script src="{{ asset('bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('DataTables/DataTables-1.13.6/js/jquery.dataTables.min.js') }}" type="text/javascript" charset="utf8" ></script>
    <script src="{{ asset('DataTables/KeyTable-2.10.0/js/dataTables.keyTable.min.js') }}"></script>    
  @endif
