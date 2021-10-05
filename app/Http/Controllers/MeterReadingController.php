<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Services\MeterReadingService;
use App\Models\MeterReadings;
use Illuminate\Http\Request;

class MeterReadingController extends Controller
{
    private $meterReadingService;

    public function __construct()
    {
        $this->meterReadingService = new MeterReadingService();
    }

    public function getReading($smartMeterId) {
        return response()->json( $this->meterReadingService->getReadings($smartMeterId), 200);
    }

    public function storeReadings(Request $request)
    {
        var_dump($request);
        // $res = $this->meterReadingService->storeReadings($request->all()["smartMeterId"],$request->all()["electricityReadings"]);
        return response()->json("{SUCCESS}", 201);
    }

}
