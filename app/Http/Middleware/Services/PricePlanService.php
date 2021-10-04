<?php

namespace App\Http\Middleware\Services;

use App\Models\PricePlan;

class PricePlanService
{
    private $meterReadingService;
    private $pricePlan;

    public function __construct()
    {
        $this->pricePlan = new PricePlan();
        $this->meterReadingService = new MeterReadingService();
    }

    public function getConsumptionCostOfElectricityReadingsForEachPricePlan($smartMeterId){
        $electricityReadings = [];
        $electricityReadings = $this->meterReadingService->getReadings($smartMeterId);

        if(is_null($electricityReadings)){
            return $electricityReadings;
        }

        $recommendedPlan = $this->calculateCost($electricityReadings);
        return $recommendedPlan;
    }

    public function calculateCost($electricityReadings){
        $averageCost = $this->calculateAverageReading($electricityReadings);
        return $averageCost;
    }

    public function calculateAverageReading($electricityReadings)
    {
        $newSummedReadings = 0;
        foreach (array($electricityReadings) as $electricityReading){
            foreach($electricityReading as ["readings" => $reading]){
                $newSummedReadings += $reading;
            }
        }

        return $newSummedReadings / count($electricityReadings);
    }

    public function calculateTimeElapsed($electricityReadings)
    {

    }
}
