<?php

declare(strict_types=1);

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model
{
    protected $table = 'client';

    protected $fillable = [
        'full_name',
        'email',
        'timezone'
    ];
}
