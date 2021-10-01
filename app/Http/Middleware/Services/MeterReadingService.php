<?php

namespace App\Http\Middleware\Services;

class MeterReadingService
{
    public function getReadings(){
        $meterReadingsInitialize = new MeterReadingsInitialize();
        $meterReadings = $meterReadingsInitialize->generateMeterElectricityReadings();
        return $meterReadings;
    }
}
