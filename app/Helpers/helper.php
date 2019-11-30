<?php

use App\Currency;
use Carbon\Carbon;

function curlGet($url)
{
    $agent = "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // In case if the first link redirects to some where else
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    //  curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);


    $header[] = "Accept-Language: en-US,en;q=0.5";

    $responseData = curl_exec($ch);

    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


    if ($httpcode === 200) {

        $fileContents = str_replace(array("\n", "\r", "\t"), '', $responseData);
        $fileContents = trim(str_replace('"', "'", $fileContents));
        $simpleXml = simplexml_load_string($fileContents);
        $json = json_encode($simpleXml);

        return $json;
    } else {
        return null;
    }

}

function getExchange($date, $day)
{

    $url = dateFormatWithUrl($date, $day);


    $data = curlGet($url);

    if ($data == null) {

        while ($data == null) {
            $day++;
            $url = dateFormatWithUrl($date, $day);
            $data = curlGet($url);
        }
    }

    $invoiceDate = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');

    Currency::create([
        'date' => $invoiceDate,
        'rate' => $data
    ]);

    return $data;
}

function dateFormatWithUrl($date, $count = 0)
{
    $invoiceDate = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');

    if ($count != 0) {
        $invoiceDate = Carbon::parse($invoiceDate)->subDays($count);
    }

    $year = Carbon::parse($invoiceDate)->year;
    $month = Carbon::parse($invoiceDate)->month;
    $day = Carbon::parse($invoiceDate)->day;

    $day = strlen($day) != 2 ? '0' . $day : $day;
    $month = strlen($month) != 2 ? '0' . $month : $month;
    $path1 = $year . $month;
    $path2 = $day . $month . $year;

    $url = 'https://www.tcmb.gov.tr/kurlar/' . $path1 . '/' . $path2 . '.xml';
    return $url;
}
