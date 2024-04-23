<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class Download extends Controller
{
    public function download(){
        
        $client = new Client([
            'headers' => [
                'authToken' => 'eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJhZG1pbkBjbXMuY29tIiwiaWF0IjoxNzEzODM2MjIyLCJleHAiOjE3MTM5MjI2MjJ9.23ZHO-eyU8ISaq1FfJq0vnKE-sBHtnyijnymnPNb40qI9qfpuWrIObL4bPNP98dERpxMMOcqjisPunDrRkuTZA',
                'Content-Type' => 'application/json', 
                'api-key' => '7e0567e5-7048-438b-861c-7a902e04b0cf', 
                'X-Content-Type-Options' => 'nosniff', 
                'X-Frame-Options' => 'SAMEORIGIN', 
                'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains; preload', 
                'X-XSS-Protection' => '1; mode=block'
            ]
        ]);
        $body = ['body' => json_encode(
            [
                'startDate' => '2024-02-19',
                'endDate' => '2024-04-05'
            ]
        )];

        
        $res = $client->post('https://api-otoransi-dev.berijalan.id/rest/v1/claim/download-list-bucket-claim', $body);
        $file = $res->getBody()->getContents();

        $fileName = 'test.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename='. $fileName.';',
        ];
        return response()->streamDownload(function() use ($file){
            echo $file;
        }, $fileName, $headers);
    }
}
