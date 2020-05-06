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

        foreach ($data as $key => $value) {
            var_dump($value['start']);
//            var_dump(array_keys($value));
//            foreach ($value as $k => $v) {
//                var_dump(array_keys($value));
//            }
        }
//        var_dump($data); die();
//        return new DetailReportsDisplayDto($data);
    }
}
