<?php

declare(strict_types=1);

namespace App\Models\DetailReports;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetailReports
 * @package App\Models\DetailReports
 * @property int $id
 * @property string $json
 * @property string $start_date
 * @property string $last_date
 */
class DetailReports extends Model
{
    public $table = 'detail_reports';

    public $fillable = [
        'json',
        'start_date',
        'last_date'
    ];
}
