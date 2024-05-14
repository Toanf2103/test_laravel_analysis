<?php

namespace App\Services;

use App\Models\AnalysisPrice;
use App\Models\AnalysisPriceStatus;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Datatables;

class AnalysisPriceService
{
    public function index($filters)
    {
        $data = AnalysisPrice::join('users', 'analysis_prices.customer_id', '=', 'users.id')
            ->leftJoin('analysis_price_statuses', 'analysis_prices.status_id', '=', 'analysis_price_statuses.id')
            ->leftJoin('group_customers', 'users.group_customer_id', '=', 'group_customers.id')
            ->with(['customer', 'customer.group', 'status'])
            ->select([
                'analysis_prices.id as id',
                'analysis_prices.name as name',
                'group_customers.name as group_customer_name',
                'users.full_name as customer_name',
                'analysis_prices.quantity as quantity',
                'analysis_prices.amount as amount',
                'analysis_price_statuses.name as status_name',
                'analysis_price_statuses.value as status_value',
                'analysis_price_statuses.class_color as status_class_color',
            ]);
        return Datatables::of($data)
            ->setRowId(function ($row) {
                return $row->id;
            })
            ->addColumn('status', function ($row) {
                return view('pages.analysis_price.status', compact('row'));
            })
            ->addColumn('action', function ($row) {
                return view('pages.analysis_price.action', compact('row'));
            })
            ->editColumn('group_customer_name', function ($data) {
                return $data->group_customer_name ? $data->group_customer_name : 'N/A';
            })
            ->editColumn('created_at', function ($row) {
                return formatDate($row->created_at);
            })
            ->editColumn('amount', function ($row) {
                return formatCurrency($row->amount);
            })
            ->editColumn('name', function ($row) {
                return $row->name;
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function store($data)
    {
        return AnalysisPrice::create([
            ...$data,
            'status_id' => AnalysisPriceStatus::where('value', 'wait')->value('id')
        ]);
    }

    public function update(AnalysisPrice $analysisPrice, $data)
    {
        return $analysisPrice->update($data);
    }
}
