<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Services\PricePlanService;
use Illuminate\Http\Request;

class PricePlanComparatorController extends Controller
{
    public function recommendCheapestPricePlans($smartMeterId){
        $pricePlanService = new PricePlanService();
        return response()->json($pricePlanService->getConsumptionCostOfElectricityReadingsForEachPricePlan($smartMeterId), 200);
    }
}
