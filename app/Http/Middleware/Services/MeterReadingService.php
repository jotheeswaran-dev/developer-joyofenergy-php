<?php

namespace App\Http\Middleware\Services;

class MeterReadingService
{
    public function getReadings($smartMeterId){
        $meterReadingsInitialize = new MeterReadingsInitialize();
        $meterReadings = $meterReadingsInitialize->generateMeterElectricityReadings($smartMeterId);
        return $meterReadings;
    }

}
