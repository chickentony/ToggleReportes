<?php

declare(strict_types=1);

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientsToken extends Model
{
    public $table = 'client_tokens';

    public $primaryKey = 'id';

    public $fillable = [
        'id',
        'client_id',
        'token'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(ClientsModel::class);
    }
}
