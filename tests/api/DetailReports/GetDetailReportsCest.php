<?php

declare(strict_types=1);

namespace Tests\api\DetailReports;

use ApiTester;
use Codeception\Util\HttpCode;

class GetDetailReportsCest
{
    private $url = '/api/detail-reports/%s';
    private $worksapceId = 3525302;

    public function requestShouldReturn200ResponseCode(ApiTester $I): void
    {
        $I->sendGET($this->getUrl($this->worksapceId));

        $I->seeResponseCodeIs(HttpCode::OK);
    }

    private function getUrl($workspaceId): string
    {
        return sprintf($this->url, $workspaceId);
    }
}
