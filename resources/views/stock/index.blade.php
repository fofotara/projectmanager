@extends('layouts.backend');
@section('content')
    <div class="content" id="stock">
<stock-index></stock-index>
    </div>
    @stop
@section('js_after')
    <script src="{{ asset('js/stock.js') }}"></script>
    @stop
