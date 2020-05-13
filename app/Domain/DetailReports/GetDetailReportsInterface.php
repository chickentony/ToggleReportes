<?php

declare(strict_types=1);

namespace App\Domain\DetailReports;

interface GetDetailReportsInterface
{
    /**
     * @param int $workspaceId
     * @return DetailReportsDisplayDto
     */
    public function getDetailReports(int $workspaceId): DetailReportsDisplayDto;

    /** @return DetailReportsDisplayDto */
    public function getDetailReportsByDate(): DetailReportsDisplayDto;
}
