<?php

declare(strict_types=1);

namespace App\Domain\DetailReports;

class DetailReportsDisplayDto
{
    public $detailReports;

    public function __construct(array $detailReports)
    {
        $this->detailReports = $detailReports;
    }
}
