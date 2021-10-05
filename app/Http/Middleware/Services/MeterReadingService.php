<?php

namespace App\Http\Middleware\Services;

class MeterReadingService
{
    private $meterReadingInitializer;
    public function __construct(){
        $this->meterReadingInitializer = new MeterReadingsInitialize();
    }

    public function getReadings($smartMeterId){
        $getElectricityReadings = $this->meterReadingInitializer->electricityReadings;
        $smartMeterIdReadings = [];
        foreach ($getElectricityReadings as $getElectricityReading){
            if($getElectricityReading["smartMeterId"] == $smartMeterId){
                $smartMeterIdReadings = $getElectricityReading["electricityReadings"];
            }
        }
        return $smartMeterIdReadings;
    }

}
