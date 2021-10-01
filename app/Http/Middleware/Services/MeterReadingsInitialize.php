<?php

namespace App\Http\Middleware\Services;


use App\Models\ElectricityReading;
use Nette\Utils\Random;
use phpDocumentor\Reflection\Types\Integer;
use function Sodium\add;

class MeterReadingsInitialize
{
    public $smartMeterToPricePlanAccounts = [];

    public function generateMeterElectricityReadings(){
        $readings = [];
        $smartMeterIds = $this->getSmartMeterToPricePlanAccounts();

        foreach ($smartMeterIds as $smartMeterId){
            $readings[$smartMeterId['id']] = $this->generate(5);
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

    public function generate($number){
        $electricityReadings = [];
        for($i = 0; $i < $number; $i++)
        {
            $electricityReading = [];
            $reading = mt_rand (10,100) / 550;
            $electricity = new ElectricityReading(new \DateTime(), $reading);
            array_push($electricityReading, $electricity->reading, $electricity->time);
            array_push($electricityReadings, $electricityReading);
        }
        return $electricityReadings;
    }
}
