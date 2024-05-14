<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalysisPriceStatus extends Model
{
    use HasFactory;

    protected $fillalbe = [
        'name',
        'value',
        'class_color'
    ];

    public function analysisPrice()
    {
        return $this->hasMany(AnalysisPrice::class, 'status_id', 'id');
    }
}
