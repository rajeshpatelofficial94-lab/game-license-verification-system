<?php

namespace App\Services\Licensing;

use App\Services\Licensing\DTOs\LicenseStatus;
use App\Services\Licensing\DTOs\RestrictionInfo;
use App\Services\Licensing\DTOs\AgeValidation;
use App\Services\Licensing\DTOs\RegionList;

class LicenseVerificationService
{
    private array $licenses = [
        ['game_id' => 'game-1', 'region' => 'US', 'is_active' => true],
        ['game_id' => 'game-1', 'region' => 'EU', 'is_active' => true],
        ['game_id' => 'game-1', 'region' => 'BR', 'is_active' => true],
        ['game_id' => 'game-2', 'region' => 'JP', 'is_active' => true],
    ];

    private array $regionalRestrictions = [
        'game-1' => ['CN', 'RU', 'BR'],
        'game-2' => ['CN'],
    ];

    private array $gdprRestrictedRegions = ['CN', 'RU'];

    private array $staticUsers = [
        1 => [
            'id' => 1,
            'name' => 'John Doe',
            'birthdate' => '2005-05-20',
        ],
        2 => [
            'id' => 2,
            'name' => 'Jane Smith',
            'birthdate' => '1990-10-10',
        ],
    ];

    private array $ageRatings = [
        'game-1' => 18,
        'game-2' => 12,
    ];

    public function verifyLicense(string $gameId, string $region): LicenseStatus
    {
        $license = collect($this->licenses)->first(function ($item) use ($gameId, $region) {
            return $item['game_id'] === $gameId && $item['region'] === $region;
        });

        return new LicenseStatus($license !== null && $license['is_active']);
    }

    private function filterGdprCompliantRegions(array $regions): array
    {
        return array_values(array_filter($regions, function ($region) {
            return !in_array($region, $this->gdprRestrictedRegions);
        }));
    }

    public function checkRegionalRestrictions(string $gameId): RestrictionInfo
    {
        $restrictedRegions = $this->regionalRestrictions[$gameId] ?? [];

        $gdprCompliant = $this->filterGdprCompliantRegions($restrictedRegions);

        return new RestrictionInfo($gdprCompliant);
    }


    public function validateAgeRating(string $gameId, string $userId): AgeValidation
    {
        if (!isset($this->staticUsers[$userId])) {
            return new AgeValidation(false);
        }

        $minimumAge = $this->ageRatings[$gameId] ?? 18;
        $birthdate = $this->staticUsers[$userId]['birthdate'];

        $userAge = now()->diff(\Carbon\Carbon::parse($birthdate))->y;

        return new AgeValidation($userAge >= $minimumAge);
    }


    public function getAvailableRegions(string $gameId): RegionList
    {
        $regions = collect($this->licenses)
            ->where('game_id', $gameId)
            ->where('is_active', true)
            ->pluck('region')
            ->unique()
            ->toArray();

        $gdprCompliant = $this->filterGdprCompliantRegions($regions);

        return new RegionList($gdprCompliant);
    }

}
