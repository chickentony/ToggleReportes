<?php

namespace App\Http\Controllers\Reports\DetailReports;

use App\Http\Controllers\Controller;
use App\Http\Responses\ResponseFactory;
use App\Services\Reports\DetailReports\DetailReportsService;
use App\Services\Reports\ReportsForm\ReportsValidationForm;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoreDetailReportsController extends Controller
{
    public function storeDetailReports(Request $request): JsonResponse
    {
        $form = new ReportsValidationForm();
        if ($form->validate($request->get('data')) === false) {
            return new JsonResponse($form->getErrors(), 400);
        }
        $data = $request->get('data');
        $storeReportService = new DetailReportsService();
        $storeReportService->getDetailReports($data['workspace_id'], $data['user_agent']);
        $storeReportService->storeDetailReports();

        return ResponseFactory::create($request);
    }
}
