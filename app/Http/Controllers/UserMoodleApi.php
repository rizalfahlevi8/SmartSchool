<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UserMoodleApi extends Controller
{
    public function fetchApi(Request $request)
    {
        // Your API URL
        $apiUrl = 'http://localhost/moodle/webservice/rest/server.php';

        // Your API parameters
        $params = [
            'wstoken' => '77e020ae6f8d716e42ab406a4a10861c',
            'moodlewsrestformat' => 'json',
            'wsfunction' => 'core_user_get_users',
            'criteria' => [
                [
                    'key' => '',
                    'value' => '',
                ],
            ],
        ];
   
        
        // Create a Guzzle client with SSL verification disabled
        $client = new Client([
            'verify' => false,
        ]);
        
        // Make the request
        $response = $client->post($apiUrl, [
            'form_params' => $params,
        ]);
        
        // Get the response body as JSON
        $data = json_decode($response->getBody(), true);

        // dd($data);
       
        // Display the response
        return view('pages.administrasi.data-user-moodle.index',[
            'data' => $data,
    
        ])->with('title');
    }
}