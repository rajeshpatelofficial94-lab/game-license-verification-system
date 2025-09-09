<?php

namespace App\Services\Licensing\DTOs;

class RestrictionInfo
{
    public array $restrictedRegions;

    public function __construct(array $restrictedRegions)
    {
        $this->restrictedRegions = $restrictedRegions;
    }
}
