<?php

declare(strict_types=1);

namespace App\Services\AuthToken;

use Illuminate\Support\Facades\DB;

class AuthTokenHelper
{
    public static function getToken(string $columnName, $columnValue)
    {
        return DB::table('clients')->where($columnName, $columnValue)->value('token');
    }
}
