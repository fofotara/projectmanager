<?php

namespace App\Http\Controllers;

use App\CurrencyCode;
use App\Invoice;
use App\Invoicedetail;
use App\Stock;
use App\Tax;
use App\Unit;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(){
        $currencyCodes = CurrencyCode::all();
        $invoices = Invoice::all();
        return view('invoices.index', compact('currencyCodes'));
    }

    public function create(){
        $currencyCodes = CurrencyCode::all();
        $taxs = Tax::all();
        $units = Unit::all();
        return view('invoices.create', compact('currencyCodes','taxs','units'));
    }
    public function store(Request $request){
  //dd($request->all());
        $result = \DB::transaction(function () use ($request){

            $count = count($request->get('product'));
            //  dd($count,$request->all());
            $i=0;
            while ($i < $count){
                //  echo $request->get('product')[$i];
                //echo Stock::find($request->get('productId')[$i])->tax;
                //  echo  $request->get('total')[$i]."<br>";
                Invoicedetail::create([
                    'invoice_id' => $request->get('invoiceId'),
                    'stock_id' => $request->get('productId')[$i],
                    'qty' => $request->get('qty')[$i],
                    'price' => $request->get('price')[$i],
                    'subtotal' => $request->get('total')[$i],
                    'discount' => $request->get('total')[$i] - $request->get('discountTotal')[$i],
                    'tax' => Stock::find($request->get('productId')[$i])->tax,
                    'taxValue' => $request->get('tax')[$i],
                    'total' => $request->get('discountTotal')[$i],


                ]);

                $i++;
            }

            $invoice = Invoice::find($request->get('invoiceId'))
                ->update([
                    'amount' => $request->get('sub_total'),
                    'discount' => $request->get('total_discount') == null ? 0: $request->get('total_discount'),
                    'lastAmount' =>$request->get('sub_total') - $request->get('total_discount'),
                    'tax' => $request->get('total_tax'),
                    'total' => $request->get('total_amount'),

                ]);

        });



    }
}
