<?php

namespace Tests\Unit;

use App\Http\Middleware\Services\MeterReadingService;
use PHPUnit\Framework\Constraint\Count;
use PHPUnit\Framework\TestCase;

class MeterReadingServiceTest extends TestCase
{
    /**
     * @test
     */
    public function ShouldAssertMeterReadingsCountWhenValidSmartMeterIdIsPassed()
    {
        $meterReadingService = new MeterReadingService();
        $readings = $meterReadingService->getReadings("smart-meter-1");
        $this->assertEquals(5, count($readings));
    }

    /**
     * @test
     */
    public function ShouldNotAssertMeterReadingsCountWhenInvalidSmartMeterIdIsPassed()
    {
        $meterReadingService = new MeterReadingService();
        $readings = $meterReadingService->getReadings("smart-meter-10");
        $this->assertEquals(0, count($readings));
        $this->assertEquals([], $readings);
    }
}

