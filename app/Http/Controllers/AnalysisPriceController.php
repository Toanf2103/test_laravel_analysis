<?php

namespace App\Http\Controllers;

use App\Services\AnalysisPriceStatusService;
use App\Services\GroupCustomerService;
use App\Services\UserService;

class AnalysisPriceController extends Controller
{
    public function __construct(
        protected GroupCustomerService $groupSer,
        protected UserService $user,
        protected AnalysisPriceStatusService $anaStatusSer
    ) {
        //
    }

    public function index()
    {
        $users = $this->user->getAll();
        $listStatus = $this->anaStatusSer->getAll();
        return view('pages.analysis_price.analysis', compact('users', 'listStatus'));
    }
}
