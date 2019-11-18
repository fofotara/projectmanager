@extends('layouts.backend');
@section('content')
    <div class="content" id="cari">
        <invoice-index></invoice-index>
    </div>
@stop
@section('js_after')
    <script src="{{ asset('js/invoices.js') }}"></script>
@stop
