<?php

declare(strict_types=1);

namespace App\Repositories\DetailReports;

use App\Models\DetailReports\DetailReports;
use App\Repositories\NotFoundException;

class EloquentDetailReportsRepository
{
    /**
     * @return array
     */
    public function findAll(): array
    {
        return DetailReports::all()
            ->all();
    }

    public function findReportByWorkspaceId(int $workspaceId)
    {
        $model = DetailReports::query()
            ->where('workspace_id', $workspaceId)
            ->orderByDesc('created_at')
            ->first();

        if ($model === null) {
            throw new NotFoundException("There are no reports with {$workspaceId} workspace id");
        }

        return $model;
    }
}
