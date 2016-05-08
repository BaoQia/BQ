@extends('layouts.profile-layout')

@section('profile-title')
{{ trans('messages.myCars') }}
@endsection
@section('javascript') 
<link rel="stylesheet" type="text/css" href="{{ asset('/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/dataTables.colReorder.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/dataTables.tableTools.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/dataTables.colVis.css') }}">   
<link rel="stylesheet" type="text/css" href="{{ asset('/css/dataTables.responsive.css') }}">
<script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

@endsection
@section('profile-form')

  <!-- Content!!
  ============================================= -->	
  <div class="col-md-12" style="padding:40px">
  {!! $table->render() !!}
  {!! $table->script() !!}
  </div>
  <a class="button button-3d button-green fright" href="createcar">Add Car</a>
  </div>
@endsection



