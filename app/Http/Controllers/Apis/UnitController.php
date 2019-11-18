<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $unit = Unit::orderBy('name')->get();
        return response()->json($unit);
    }
}
