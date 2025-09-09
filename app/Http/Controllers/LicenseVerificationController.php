<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Services\Licensing\LicenseVerificationService;

class LicenseVerificationController extends Controller
{
    private LicenseVerificationService $licenseService;

    public function __construct(LicenseVerificationService $licenseService)
    {
        $this->licenseService = $licenseService;
    }

    public function verifyLicense(Request $request)
    {
        $gameId = $request->input('game_id');
        $region = $request->input('region');

        $result = $this->licenseService->verifyLicense($gameId, $region);

        return response()->json([
            'is_valid' => $result->isValid,
        ]);
    }

    public function checkRegionalRestrictions(Request $request)
    {
        $gameId = $request->input('game_id');

        $result = $this->licenseService->checkRegionalRestrictions($gameId);

        return response()->json([
            'restricted_regions' => $result->restrictedRegions,
        ]);
    }

    public function validateAgeRating(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'game_id' => 'required|string',
            'user_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $gameId = $request->input('game_id');
        $userId = $request->input('user_id');

        $result = $this->licenseService->validateAgeRating($gameId, $userId);

        return response()->json([
            'age_valid' => $result->isValid,
        ]);
    }

    public function getAvailableRegions(Request $request)
    {
        $gameId = $request->input('game_id');

        $result = $this->licenseService->getAvailableRegions($gameId);

        return response()->json([
            'available_regions' => $result->regions,
        ]);
    }
}
