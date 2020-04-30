<?php

declare(strict_types=1);

namespace App\Services\Validations;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

abstract class AbstractValidationForm
{
    /** @var MessageBag */
    protected $errorMessages;

    public function validate(array $data): bool
    {
        $validator = Validator::make($data, $this->rules());
        $this->errorMessages = $validator->getMessageBag();

        return !$validator->fails();
    }

    public function getErrors(): array
    {
        return $this->errorMessages ? $this->errorMessages->getMessages() : [];
    }

    public function getFirstErrorMessage(): string
    {
        return $this->errorMessages ? $this->errorMessages->first() : '';
    }

    abstract protected function rules(): array;
}
