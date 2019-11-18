<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index(){
        $tax = Tax::orderBy('value')->get();
        return response()->json($tax);
    }
}
