<?php

namespace App\Http\Middleware\Services;


use App\Models\ElectricityReading;
use Nette\Utils\Random;
use phpDocumentor\Reflection\Types\Integer;

class MeterReadingsInitialize
{
    public $smartMeterToPricePlanAccounts = [];

    public function generateMeterElectricityReadings(){
        $readings = [];

        $smartMeterIds = $this->getSmartMeterToPricePlanAccounts();

        foreach ($smartMeterIds as $smartMeterId){
            $readings[$smartMeterId['id']] = $this->generate();
        }

        return $readings;
    }

    public function getSmartMeterToPricePlanAccounts(){
        $this->smartMeterToPricePlanAccounts = [
            ['id' => 'smart-meter-0', 'value' => 'DrEvilsDarkEnergy'],
            ['id' => 'smart-meter-1', 'value' => 'TheGreenEcoSystem'],
            ['id' => 'smart-meter-2', 'value' => 'PowerForEveryone'],
            ['id' => 'smart-meter-3', 'value' => 'ATheGreenEco'],
        ];

        return $this->smartMeterToPricePlanAccounts;
    }

    public function generate(){
        $electricityReadings = [];
        $decimals = 2; // number of decimal places
        $div = pow(10, $decimals);
        for($i = 0; $i < 5; $i++)
        {
            $reading = 0.12132321;
            $time = new \DateTime("2021-10-01T11:32:05.253872+05:30");
            $electricityReading = new ElectricityReading($time, $reading);
            $electricityReadings = [$electricityReading->reading, $electricityReading->time];
        }
        return $electricityReadings;
    }
}
