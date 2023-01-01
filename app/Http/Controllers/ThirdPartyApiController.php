<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ThirdPartyApiController extends Controller
{
    public function dwa(Request $request) {
      $client = new Client();

      $uri = "https://www.dwa.ma/api/v1/search?type=medicaments&word=" . $request->word;

      $response = $client->request('GET', $uri);

      return $response->getBody()->getContents();
    }
}
