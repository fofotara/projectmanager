<?php

namespace App\Http\Controllers;

use App\Currency;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Cassandra\Collection;
use GuzzleHttp\Client;
use Illuminate\Http\Request;


class ExchangeController extends Controller
{
    // https://www.tcmb.gov.tr/kurlar/201801/30012018.xml
    function __construct()
    {

        $currentDate = Carbon::now()->format('Y-m-d');

        $result = Currency::where('date', $currentDate)->get();

        dump($result->count());

        if ($result->count() == 0) {
            $url = 'http://www.tcmb.gov.tr/kurlar/today.xml';

            $agent = "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // In case if the first link redirects to some where else
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_USERAGENT, $agent);
            $header[] = "Accept-Language: en-US,en;q=0.5";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            $responseData = curl_exec($ch);

            $fileContents = str_replace(array("\n", "\r", "\t"), '', $responseData);
            $fileContents = trim(str_replace('"', "'", $fileContents));

            $simpleXml = simplexml_load_string($fileContents);
            $json = json_encode($simpleXml);

            $array = json_decode($json, TRUE);

            $dates = $array['@attributes']['Date'];

            $dates = Carbon::createFromFormat('m/d/Y', $dates)->format('Y-m-d');

            // return $dates;

            // return $array;

            Currency::create(
                [
                    'date' => $dates,
                    'rate' => $json
                ]
            );
        }
    }

    public function getExchange()
    {

        return $currentDate = Carbon::now()->format('d-m-Y');
    }
}
