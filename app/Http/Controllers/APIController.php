<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class APIController extends Controller
{
    private $apiUrl = "https://online-movie-database.p.rapidapi.com/actors/v2/get-born-today";

    private $apiHost = "online-movie-database.p.rapidapi.com";

    public function getBornToday(Request $request)
    {
        $birthdate = $request->query('birthdate');
        $day = substr($birthdate, 5, 2);
        $month = substr($birthdate, 8, 2);

        $response = Http::withHeaders([
            'X-RapidAPI-Host' => $this->apiHost,
            'X-RapidAPI-Key' => env('API_KEY',''),
        ])->get($this->apiUrl, [
            'today' => "$month-$day",
            'first' => 3,
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }

        $bornTodayIds = $response->json();
        $actors = [];

        if (isset($bornTodayIds['data']['bornToday'])) {
            $edges = $bornTodayIds['data']['bornToday']['edges'];
            foreach ($edges as $edge) {
                $actorData = $this->getActorBio($edge['node']['id']);
                $actors[] = $actorData['data']['name']['nameText']['text'];
            }
            return response()->json($actors);
        } else {
            return response()->json(['message' => 'No actors found born on this date.']);
        }
    }

    private function getActorBio($actorID)
    {
        $response = Http::withHeaders([
            'X-RapidAPI-Host' => $this->apiHost,
            'X-RapidAPI-Key' =>env('API_KEY',''),
        ])->get("https://online-movie-database.p.rapidapi.com/actors/v2/get-bio", [
            'nconst' => $actorID,
        ]);

        if ($response->failed()) {
            throw new \Exception('Failed to fetch actor bio');
        }

        return $response->json();
    }
}
