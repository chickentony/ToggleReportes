<?php

declare(strict_types=1);

namespace App\Domain\DetailReports;

interface GetDetailReportsInterface
{
    /** @return DetailReportsDisplayDto */
    public function getDetailReports(): DetailReportsDisplayDto;

    /** @return DetailReportsDisplayDto */
    public function getDetailReportsByDate(): DetailReportsDisplayDto;
}
