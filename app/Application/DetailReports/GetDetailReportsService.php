<?php

declare(strict_types=1);

namespace App\Application\DetailReports;

use App\Domain\DetailReports\DetailReportsDisplayDto;
use App\Domain\DetailReports\GetDetailReportsInterface;
use App\Repositories\DetailReports\EloquentDetailReportsRepository;

class GetDetailReportsService implements GetDetailReportsInterface
{
    private $detailReportsRepository;

    public function __construct(EloquentDetailReportsRepository $detailReportsRepository)
    {
        $this->detailReportsRepository = $detailReportsRepository;
    }

    public function getDetailReports(): DetailReportsDisplayDto
    {
        $reports = $this->detailReportsRepository->findAll();
        $result = json_decode($reports[0]->json, true);

        return new DetailReportsDisplayDto($result);
    }

    public function getDetailReportsByDate()
    {
        $reports = $this->detailReportsRepository->findAll();
        $json = json_decode($reports[0]->json, true);
        $data = $json['data'];
        $result = [];

        foreach ($data as $key => $value) {
            $val = '2020-04-22';
            if (preg_match('/\d{4}-\d{2}-\d{2}/', $value['start'], $res)) {
                foreach ($res as $v) {
                    if ($v === $val) {
                        $result[] = $value;
                    }
                }
            }
        }

        return new DetailReportsDisplayDto($result);
    }
}
