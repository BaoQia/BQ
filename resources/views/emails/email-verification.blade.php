@extends('layouts.email')
@section('content')
{{ trans('messages.clickHereToActivate') }}: <br /><a href='{{ url('auth/verify/'.$id.'/'.$token) }}'>{{ url('auth/verify/'.$id.'/'.$token) }}</a>
@endsection