<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Services\MeterReadingService;
use App\Models\MeterReadings;
use Illuminate\Http\Request;

class MeterReadingController extends Controller
{
    public function getReading() {
        $meterReadingService = new MeterReadingService();
        return response()->json([
                "message" => $meterReadingService->getReadings("smart-meter-0")
            ], 200);
    }
}
