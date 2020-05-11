<?php

declare(strict_types=1);

namespace App\Application\DetailReports;

use App\Domain\DetailReports\DetailReportsDisplayDto;
use App\Domain\DetailReports\GetDetailReportsInterface;
use App\Repositories\DetailReports\EloquentDetailReportsRepository;
use App\Repositories\NotFoundException;

class GetDetailReportsService implements GetDetailReportsInterface
{
    /** @var EloquentDetailReportsRepository */
    private $detailReportsRepository;

    /**
     * GetDetailReportsService constructor.
     * @param EloquentDetailReportsRepository $detailReportsRepository
     */
    public function __construct(EloquentDetailReportsRepository $detailReportsRepository)
    {
        $this->detailReportsRepository = $detailReportsRepository;
    }

    /**
     * @param int $workspaceId
     * @return DetailReportsDisplayDto
     * ToDo: обавить проверку, если массив пустой возвращать пустой массив
     * @throws NotFoundException
     */
    public function getDetailReports(int $workspaceId): DetailReportsDisplayDto
    {
//        $reports = $this->detailReportsRepository->findAll();
        $reports = $this->detailReportsRepository->findReportByWorkspaceId($workspaceId);
        $result = json_decode($reports->json, true);

        return new DetailReportsDisplayDto($result);
    }

    /**
     * @return DetailReportsDisplayDto
     * ToDo: доделать, сейчас репорты можно достать по точному совпадению даты, то есть за конкретный день.
     */
    public function getDetailReportsByDate(): DetailReportsDisplayDto
    {
        $reports = $this->detailReportsRepository->findAll();
        $json = json_decode($reports[0]->json, true);
        $data = $json['data'];
        $result = [];
        foreach ($data as $key => $value) {
            $val = '2020-04-22';
            if (preg_match('/\d{4}-\d{2}-\d{2}/', $value['start'], $matches)) {
                foreach ($matches as $match) {
                    if ($match === $val) {
                        $result[] = $value;
                    }
                }
            }
        }

        return new DetailReportsDisplayDto($result);
    }
}
