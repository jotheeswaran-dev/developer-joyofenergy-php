<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Type\Decimal;

class ElectricityReading extends Model
{
    public $time;
    public $reading;

    function __construct($time, $reading)
    {
        $this->time = $time;
        $this->reading = $reading;
    }
}
