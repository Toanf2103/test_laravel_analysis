<?php

namespace App\Services;

use App\Models\AnalysisPrice;
use App\Models\AnalysisPriceStatus;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Datatables;

class AnalysisPriceStatusService
{
    public function getAll()
    {
        return AnalysisPriceStatus::all();
    }
}
