<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Services\PricePlanService;
use Illuminate\Http\Request;

class PricePlanComparatorController extends Controller
{
    public function recommendCheapestPricePlans($smartMeterId, $limit = 0){
        $pricePlanService = new PricePlanService();

        $recommendedPlans = $pricePlanService->getConsumptionCostOfElectricityReadingsForEachPricePlan($smartMeterId);
        $recommendedPlansAfterSorting = $this->sortPlans($recommendedPlans);

        if($limit != 0 && $limit < count($recommendedPlans)){
            $recommendedPlansAfterSorting = array_slice($recommendedPlansAfterSorting , 0, $limit);
        }
        return response()->json($recommendedPlansAfterSorting, 200);
    }

    private function sortPlans($recommendedPlans){
        $sortedPlans = array_column($recommendedPlans, 'value');
        array_multisort($sortedPlans, SORT_ASC, $recommendedPlans);
        return $recommendedPlans;
    }
}
