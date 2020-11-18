<?php

declare(strict_types=1);

namespace App\Models\DetailReports;


use Illuminate\Database\Eloquent\Model;

/**
 * Class DetailReportsItemsModel
 * @package App\Models\DetailReports
 * @property int $id
 * @property int $detail_report_id
 * @property string $report_data
 * @property string $start_date
 */
class DetailReportsItemsModel extends Model
{
    public $table = 'detail_reports_items';

    public static function create(int $detailReportId, $detailReport)
    {

    }
}
