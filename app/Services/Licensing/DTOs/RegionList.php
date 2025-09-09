<?php

namespace App\Services\Licensing\DTOs;

class RegionList
{
    public array $regions;

    public function __construct(array $regions)
    {
        $this->regions = $regions;
    }
}
