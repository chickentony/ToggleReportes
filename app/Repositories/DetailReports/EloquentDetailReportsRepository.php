<?php

declare(strict_types=1);

namespace App\Repositories\DetailReports;

use App\Models\DetailReports\DetailReports;

class EloquentDetailReportsRepository
{
    public function findAll(): array
    {
        return DetailReports::all()
            ->all();
    }
}
