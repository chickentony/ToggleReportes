<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports\DetailReports;

use App\Domain\DetailReports\GetDetailReportsInterface;
use App\Http\Controllers\Controller;
use App\Http\Responses\ResponseFactory;
use Illuminate\Http\Request;

class GetDetailReportsController extends Controller
{
    private $getDetailReportService;

    public function __construct(GetDetailReportsInterface $getDetailReportService)
    {
        $this->getDetailReportService = $getDetailReportService;
    }

    public function __invoke(Request $request)
    {
        $reports = $this->getDetailReportService->getDetailReports();
//        $reports = $this->getDetailReportService->getDetailReportsByDate();

        return ResponseFactory::create($request, $reports);
    }
}
