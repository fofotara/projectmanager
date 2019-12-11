<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function SettingInvoice()
    {
        return view('settings.index');
    }
    public function SettingInvoiceSave(Request $request)
    {
        \Setting::set('invoice',[
            'ServiceTax' => $request->invoiceServiceTax,
            'CompanyName' => $request->invoiceCompanyName
        ]);
       // return $request->all();

        return redirect()->back();
    }
}
