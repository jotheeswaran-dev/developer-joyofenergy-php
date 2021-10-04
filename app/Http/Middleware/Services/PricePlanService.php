<?php

namespace App\Http\Middleware\Services;

use App\Models\PricePlan;

class PricePlanService
{
    private $meterReadingService;
    private $meterReadingInitializer;

    public function __construct()
    {
        $this->meterReadingService = new MeterReadingService();
        $this->meterReadingInitializer = new MeterReadingsInitialize();
    }

    public function getConsumptionCostOfElectricityReadingsForEachPricePlan($smartMeterId){
        $electricityReadings = $this->meterReadingService->getReadings($smartMeterId);

        if(is_null($electricityReadings)){
            return $electricityReadings;
        }

        $getCostForAllPlans = [];
        $pricePlans = $this->meterReadingInitializer->getPricePlans();
        foreach ($pricePlans as $pricePlan) {
            $getCostForAllPlans[] = array('key' => $pricePlan->supplier, 'value' => $this->calculateCost($electricityReadings, $pricePlan));
        }

         return $getCostForAllPlans;
    }

    private function calculateCost($electricityReadings, PricePlan $pricePlan){
        $average = $this->calculateAverageReading($electricityReadings);
        $timeElapsed = $this->calculateTimeElapsed($electricityReadings);
        $averagedCost = $average/$timeElapsed;
        return $averagedCost * $pricePlan->unitrate;
    }

    private function calculateAverageReading($electricityReadings)
    {
        $newSummedReadings = 0;
        foreach (array($electricityReadings) as $electricityReading){
            foreach($electricityReading as ["readings" => $reading]){
                $newSummedReadings += $reading;
            }
        }

        return $newSummedReadings / count($electricityReadings);
    }

    private function calculateTimeElapsed($electricityReadings)
    {
        $readingHours = [];
        foreach (array($electricityReadings) as $electricityReading) {
            foreach ($electricityReading as ["time" => $time]) {
                $readingHours[] = $time;
            }
        }
        $minimumElectricityReading = strtotime(min($readingHours));
        $maximumElectricityReading = strtotime(max($readingHours));
        $timeElapsedInHours = abs($maximumElectricityReading - $minimumElectricityReading)/(60*60);
        return $timeElapsedInHours;
    }

}
