<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(){
        return view('invoices.index');
    }

    public function create(){
        return view('invoices.create');
    }
}
