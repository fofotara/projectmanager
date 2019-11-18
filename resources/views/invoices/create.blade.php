@extends('layouts.backend');
@section('content')
    <div class="content" id="invoice">
        <invoice-create></invoice-create>
    </div>
@stop
@section('js_after')
    <script src="{{ asset('js/invoices.js') }}"></script>
@stop
