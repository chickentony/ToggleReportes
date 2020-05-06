<?php

declare(strict_types=1);

namespace App\Domain\DetailReports;

interface GetDetailReportsInterface
{
    public function getDetailReports(): DetailReportsDisplayDto;

    public function getDetailReportsByDate();
}
