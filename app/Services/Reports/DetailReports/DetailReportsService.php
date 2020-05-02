<?php

declare(strict_types=1);

namespace App\Services\Reports\DetailReports;

use App\Models\DetailReports\DetailReports;
use GuzzleHttp\Client;

class DetailReportsService
{
    private $response;

    public function getDetailReports(int $workspaceId, string $userAgent)
    {
        $client = new Client();
        $request = $client->request('GET', 'https://toggl.com/reports/api/v2/details', [
            'auth' => ['fedca7976df47a9ef4bb9ffff81f9c9b', 'api_token'],
            'query' => [
                'workspace_id' => $workspaceId,
                'user_agent' => $userAgent
            ]
        ]);
        $this->response = $request->getBody()->getContents();
//        var_dump($response);

    }

    public function storeDetailReports()
    {
        $reports = new DetailReports();
        $reports->json = $this->response;
        $reports->save();
    }

}
