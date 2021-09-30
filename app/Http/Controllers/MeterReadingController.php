<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeterReadingController extends Controller
{
    public function getReading() {
        return response()->json([
                "message" => "record created"
            ], 200);
    }
}
