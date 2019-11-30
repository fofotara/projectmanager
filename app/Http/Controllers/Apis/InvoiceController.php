<?php

namespace App\Http\Controllers\Apis;

use App\Currency;
use App\Currentaccount;
use App\Http\Controllers\Controller;
use App\Invoice;
use Carbon\Carbon;
use Faker\Provider\Company;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    static $perPage = 15;

    public function getCurrentAccount(Request $request)
    {
        $search = $request->get('term');
        $data = Currentaccount::where('company', 'LIKE', '%' . $search . '%')->get();
        return response()->json($data);
    }

    public function saveInvoiceHeader(Request $request)
    {

        //return \request()->all();
        // company=Yetkili%20Firma%2015&companyId=8&invoiceDate=22-11-2019&invoiceNumber=2332

        $companyId = $request->get('companyId');
        $number = $request->get('invoiceNumber');
        $date = $request->get('invoiceDate');
        $currencyCode = $request->get('currencyCode');

        $invoiceDate = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');

        $currency = Currency::where('date', $invoiceDate)
            ->pluck('rate')
            ->first();
        if (empty($currency)) {
            $currency = getExchange($date, 0);
        }
        $currency = json_decode($currency);


        $currencyPrice = 0;
        if ($currencyCode == 'USD') {
            $currencyPrice = $currency->Currency[0]->BanknoteBuying;
        } elseif ($currencyCode == 'EUR') {
            $currencyPrice = $currency->Currency[0]->BanknoteBuying;
        }

        $company = Currentaccount::whereId($companyId)->first()->toArray();

        $invoice = Invoice::create([
            'user_id' => \Auth::id(),
            'currentAccount_id' => $companyId,
            'currencyCode' => $currencyCode,
            'currency' => $currencyPrice
        ]);

        return response()->json(
            [
                'company' => $company,
                'currencyCode' => $currencyCode,
                'currency' => $currencyPrice,
                'invoiceNumber' => $number,
                'invoice' => $invoice
            ]
        );


    }
}
