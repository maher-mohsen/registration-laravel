<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class APIController extends Controller
{
    private $apiUrl = "https://online-movie-database.p.rapidapi.com/actors/v2/get-born-today";
    private $apiKey = "d3c745166amsh78848f479c8333ap1424c6jsn2af0c66fd7b1";
    private $apiHost = "online-movie-database.p.rapidapi.com";

    public function getBornToday($birthdate) {
        $curl = curl_init();
        $day   = substr($birthdate, 5, 2);
        $month = substr($birthdate, 8, 2);
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://online-movie-database.p.rapidapi.com/actors/v2/get-born-today?today=$month-$day&first=3",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                'X-RapidAPI-Host' => $this->apiHost,
                'X-RapidAPI-Key' => $this->apiKey
            ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL error #:" . $err;
            return null;
        } else {
            return json_decode($response, true);
        }
    }


    public function getActorsBIO($actorID) {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://online-movie-database.p.rapidapi.com/actors/v2/get-bio?nconst=$actorID",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                'X-RapidAPI-Host' => $this->apiHost,
                'X-RapidAPI-Key' => $this->apiKey
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL error #:" . $err;
            return null;
        } else {
            return json_decode($response, true);
        }
        
    }
}

