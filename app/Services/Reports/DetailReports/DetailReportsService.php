<?php

declare(strict_types=1);

namespace App\Services\Reports\DetailReports;

use App\Models\DetailReports\DetailReports;
use App\Repositories\DetailReports\EloquentDetailReportsRepository;
use App\Services\AuthToken\AuthTokenHelper;
use GuzzleHttp\Client;

/**
 * Class DetailReportsService
 * @package App\Services\Reports\DetailReports
 * ToDo: нужен рефакторинг
 */
class DetailReportsService
{

//    private $detailReportsRepository;

    private $url = 'https://toggl.com/reports/api/v2/details';

    private $response;

    private $startDate;

    private $lastDate;

    private $worckspaceId;

//    public function __construct(EloquentDetailReportsRepository $detailReportsRepository)
//    {
//        $this->detailReportsRepository = $detailReportsRepository;
//    }

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

    /**
     * @param $workspaceId
     * @throws \JsonException
     */
    public function storeDetailReportItems($workspaceId)
    {
        $reportsRepository = new EloquentDetailReportsRepository();
        $reports = $reportsRepository->getLastRecordByWorkspaceId($workspaceId);
        $data = json_decode($reports[0]['json'], true, 512, JSON_THROW_ON_ERROR);
        foreach ($data['data'] as $key => $value) {
            var_dump($value['start']);

        }
    }
}
