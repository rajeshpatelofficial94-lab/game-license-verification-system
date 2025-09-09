<?php

namespace App\Services\Licensing\DTOs;

class LicenseStatus
{
    public bool $isValid;

    public function __construct(bool $isValid)
    {
        $this->isValid = $isValid;
    }
}
