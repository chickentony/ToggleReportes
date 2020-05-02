<?php

declare(strict_types=1);

namespace App\Services\Reports\DetailReports;

use App\Models\DetailReports\DetailReports;
use GuzzleHttp\Client;

class DetailReportsService
{
    private $response;

    private $startDate;

    private $lastDate;

    public function getDetailReports(
        int $workspaceId,
        string $userAgent,
        string $startDate = null,
        string $lastDate = null
    ): void
    {
        $client = new Client();
        $request = $client->request('GET', 'https://toggl.com/reports/api/v2/details', [
            'auth' => ['fedca7976df47a9ef4bb9ffff81f9c9b', 'api_token'],
            'query' => [
                'workspace_id' => $workspaceId,
                'user_agent' => $userAgent,
                'since' => $startDate,
                'until' => $lastDate
            ]
        ]);
        $this->response = $request->getBody()->getContents();
        $this->startDate = $startDate;
        $this->lastDate = $lastDate;
    }

    public function storeDetailReports(): void
    {
        $reports = new DetailReports();
        $reports->json = $this->response;
        $reports->start_date = $this->startDate;
        $reports->last_date = $this->lastDate;
        $reports->save();
    }

}
