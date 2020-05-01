<?php

declare(strict_types=1);

namespace App\Services\Reports\DetailReports;

use GuzzleHttp\Client;

class DetailReportsService
{
    public function getDetailReports(int $workspaceId, string $userAgent)
    {
        $client = new Client();
        $request = $client->request('GET', 'https://toggl.com/reports/api/v2/details', []);

    }

}
