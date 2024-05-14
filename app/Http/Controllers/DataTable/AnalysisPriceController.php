<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Controllers\Controller;
use App\Http\Requests\Analysis\AnalysisRequest;
use App\Http\Requests\Analysis\AnalysisUpdateRequest;
use App\Models\AnalysisPrice;
use App\Services\AnalysisPriceService;
use Illuminate\Http\Request;

class AnalysisPriceController extends Controller
{
    public function __construct(protected AnalysisPriceService $analysisSer)
    {
    }

    public function index(Request $rq)
    {
        return $this->analysisSer->index($rq);
    }

    public function store(AnalysisRequest $rq)
    {
        $analysis = $this->analysisSer->store($rq->validated());
        return response()->json($analysis);
    }

    public function show(AnalysisPrice $analysisPrice)
    {
        return response()->json($analysisPrice);
    }

    public function update(AnalysisPrice $analysisPrice, AnalysisUpdateRequest $rq)
    {
        return $this->analysisSer->update($analysisPrice, $rq->validated());
    }
}
