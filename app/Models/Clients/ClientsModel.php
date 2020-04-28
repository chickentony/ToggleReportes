<?php

declare(strict_types=1);

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;

class ClientsModel extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'full_name',
        'email',
        'timezone'
    ];
}
