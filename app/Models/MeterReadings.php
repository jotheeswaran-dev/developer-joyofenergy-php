<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\List_;

class MeterReadings extends Model
{
    public string $smartMeterId;
    public $electricityReadings = [];
}
