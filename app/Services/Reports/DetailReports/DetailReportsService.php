<?php

declare(strict_types=1);

namespace App\Services\Reports\DetailReports;

use App\Models\DetailReports\DetailReports;
use App\Services\AuthToken\AuthTokenHelper;
use GuzzleHttp\Client;

/**
 * Class DetailReportsService
 * @package App\Services\Reports\DetailReports
 * ToDo: нужен рефакторинг
 */
class DetailReportsService
{
    private $url = 'https://toggl.com/reports/api/v2/details';

    private $response;

    private $startDate;

    private $lastDate;

    private $worckspaceId;

    public function getDetailReports(
        int $workspaceId,
        string $userAgent,
        string $startDate,
        string $lastDate
    ): void
    {
        $client = new Client();
        $token = AuthTokenHelper::getToken('workspaces_id', $workspaceId);
        $request = $client->request('GET', $this->url, [
            'auth' => [$token, 'api_token'],
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
        $this->worckspaceId = $workspaceId;
    }

    public function storeDetailReports(): void
    {
        $reports = new DetailReports();
        $reports->json = $this->response;
        $reports->start_date = $this->startDate;
        $reports->last_date = $this->lastDate;
        $reports->workspace_id = $this->worckspaceId;
        $reports->save();
    }
}
