<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalysisPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'customer_id',
        'status_id',
        'quantity',
        'amount',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(AnalysisPriceStatus::class, 'status_id', 'id');
    }
}
