<?php

declare(strict_types=1);

namespace App\Models\DetailReports;

use Illuminate\Database\Eloquent\Model;

class DetailReports extends Model
{
    public $table = 'detail_reports';

    public $fillable = [
        'json',
        'start_date',
        'last_date'
    ];
}
