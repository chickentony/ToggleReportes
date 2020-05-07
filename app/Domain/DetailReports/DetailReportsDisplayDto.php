<?php

declare(strict_types=1);

namespace App\Domain\DetailReports;

class DetailReportsDisplayDto
{
    /** @var array */
    public $detailReports;

    /**
     * DetailReportsDisplayDto constructor.
     * @param array $detailReports
     */
    public function __construct(array $detailReports)
    {
        $this->detailReports = $detailReports;
    }
}
