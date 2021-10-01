<?php

namespace App\Http\Middleware\Services;

class MeterReadingService
{
    public function getReadings(string $smartMeterId){
        $meterPlanAccounts = Config::class('InitializeMeterReading.smartMeterToPricePlanAccounts');

        $meterReadings = new \Ds\Map();
        foreach ($meterPlanAccounts as $meterPlanAccount => $smartMeterId){
            $meterReadings->put($meterPlanAccount, "1000");
        }

        return $meterReadings;
    }
}
