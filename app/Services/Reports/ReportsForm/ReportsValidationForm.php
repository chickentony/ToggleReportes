<?php

declare(strict_types=1);

namespace App\Services\Reports\ReportsForm;

use App\Services\Validations\AbstractValidationForm;

class ReportsValidationForm extends AbstractValidationForm
{
    protected function rules(): array
    {
        return [
            'workspace_id' => 'required|int',
            'user_agent' => 'required|string',
            'since' => 'date|nullable',
            'until' => 'date|nullable'
        ];
    }
}
