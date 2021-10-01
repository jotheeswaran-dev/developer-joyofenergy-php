<?php

namespace App\Http\Middleware\Services;


use App\Models\ElectricityReading;
use Nette\Utils\Random;
use phpDocumentor\Reflection\Types\Integer;
use function Sodium\add;

class MeterReadingsInitialize
{
    public $smartMeterToPricePlanAccounts = [];

    public function generateMeterElectricityReadings($smartMeterId){
        $readings = [];
        $smartMeterIds = $this->getSmartMeterToPricePlanAccounts();

        foreach ($smartMeterIds as ["id" => $smartId]) {
            if($smartId == $smartMeterId){
                $readings = $this->generate(5);
            }
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
            $reading = mt_rand (10,100) / 550;
            $electricity = new ElectricityReading(date("Y-m-d H:i:s").time(), $reading);
            array_push($electricityReadings, array('readings' => $electricity->reading, 'time' => $electricity->time));
        }
        return $electricityReadings;
    }
}
