<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Services\MeterReadingService;
use App\Models\MeterReadings;
use Illuminate\Http\Request;

class MeterReadingController extends Controller
{
    public function getReading($smartMeterId) {
        $meterReadingService = new MeterReadingService();
        return response()->json( $meterReadingService->getReadings($smartMeterId), 200);
    }
}
