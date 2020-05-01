<?php

declare(strict_types=1);

namespace App\Services\Clients;

use App\Models\Clients\ClientsModel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class RegisterService
{
    private $response;

    private $url = 'https://www.toggl.com/api/v8/me';

    /**
     * @param string $email
     * @param string $password
     * @throws GuzzleException
     */
    public function getClient(string $email, string $password): void
    {
        $client = new Client();
        $request = $client->request('GET', $this->url, [
            'auth' => [$email, $password]
        ]);
        $this->response = json_decode($request->getBody()->getContents(), true);
    }

    public function storeClient(): void
    {
        $clientData = new ClientsModel();
        $clientData->email = $this->response['data']['email'];
        $clientData->full_name = $this->response['data']['fullname'];
        $clientData->timezone = $this->response['data']['timezone'];
        $clientData->token = $this->response['data']['api_token'];
        $clientData->save();
    }
}
