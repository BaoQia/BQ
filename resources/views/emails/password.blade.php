@extends('layouts.email')
@section('content')
{{ trans('messages.clickHereToReset') }}: <br /><a href='{{ url('password/reset/'.$token) }}'>{{ url('password/reset/'.$token) }}</a>
@endsection