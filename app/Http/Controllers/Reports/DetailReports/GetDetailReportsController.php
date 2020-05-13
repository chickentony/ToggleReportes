<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports\DetailReports;

use App\Domain\DetailReports\GetDetailReportsInterface;
use App\Http\Controllers\Controller;
use App\Http\Responses\ResponseFactory;
use App\Repositories\NotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetDetailReportsController extends Controller
{
    /** @var GetDetailReportsInterface */
    private $getDetailReportService;

    /**
     * GetDetailReportsController constructor.
     * @param GetDetailReportsInterface $getDetailReportService
     */
    public function __construct(GetDetailReportsInterface $getDetailReportService)
    {
        $this->getDetailReportService = $getDetailReportService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * ToDo: реализовать get параметры в запросе
     */
    public function __invoke(Request $request)
    {
        $workspaceId = (int)$request->route('id');
        try {
            $reports = $this->getDetailReportService->getDetailReports($workspaceId);
        } catch (NotFoundException $e) {
            return ResponseFactory::create($request, [], 400, false, $e->getMessage());
        }
//        $reports = $this->getDetailReportService->getDetailReportsByDate();

        return ResponseFactory::create($request, $reports);
    }
}
