<?php

declare(strict_types=1);

namespace App\Services\Client;

use App\Models\Client\ClientModel;
use GuzzleHttp\Client;

class RegisterService
{
    public function getUser(string $email, string $password)
    {
        $client = new Client();
        $request = $client->request('GET', 'https://www.toggl.com/api/v8/me', [
            'auth' => [$email, $password]
        ]);
        $response = json_decode($request->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
//        var_dump($response);
        $clientData = new ClientModel();
        $clientData->email = $response['data']['email'];
        $clientData->full_name = $response['data']['fullname'];
        $clientData->save();
    }

}
