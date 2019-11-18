@extends('layouts.backend');
@section('content')
    <div class="content" id="cari">
        <cari-index></cari-index>
    </div>
@stop
@section('js_after')
    <script src="{{ asset('js/cari.js') }}"></script>
@stop
