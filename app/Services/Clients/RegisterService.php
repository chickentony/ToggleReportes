<?php

declare(strict_types=1);

namespace App\Services\Clients;

use App\Models\Clients\ClientsModel;
use App\Models\Clients\ClientsToken;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\DB;

class RegisterService
{
    private $response;

    /**
     * @param string $email
     * @param string $password
     * @throws GuzzleException
     */
    public function getClient(string $email, string $password): void
    {
        $client = new Client();
        $request = $client->request('GET', 'https://www.toggl.com/api/v8/me', [
            'auth' => [$email, $password]
        ]);
        $this->response = json_decode(
            $request->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR
        );
    }

    public function storeClient(): void
    {
        $clientData = new ClientsModel();
        $clientData->email = $this->response['data']['email'];
        $clientData->full_name = $this->response['data']['fullname'];
        $clientData->timezone = $this->response['data']['timezone'];
        $clientData->save();
    }

    public function storeClientToken(): void
    {
        $clientToken = new ClientsToken();
        $clientId = DB::table('clients')->where('email', $this->response['data']['email'])->value('id');
        $clientToken->token = $this->response['data']['api_token'];
        $clientToken->client_id = $clientId;
        $clientToken->save();
    }
}
