<?php

namespace App\Http\Controllers;

use App\CurrencyCode;
use App\Tax;
use App\Unit;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(){
        $currencyCodes = CurrencyCode::all();
        return view('invoices.index', compact('currencyCodes'));
    }

    public function create(){
        $currencyCodes = CurrencyCode::all();
        $taxs = Tax::all();
        $units = Unit::all();
        return view('invoices.create', compact('currencyCodes','taxs','units'));
    }
}
