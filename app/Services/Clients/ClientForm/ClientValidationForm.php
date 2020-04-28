<?php

declare(strict_types=1);

namespace App\Services\Clients\ClientForm;

use App\Services\Validations\AbstractValidationForm;

class ClientValidationForm extends AbstractValidationForm
{
    protected function rules(): array
    {
        return [
            'email' => 'required|string',
            'password' => 'required'
        ];
    }
}
