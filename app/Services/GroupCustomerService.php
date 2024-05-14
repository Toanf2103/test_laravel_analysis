<?php

namespace App\Services;

use App\Models\GroupCustomer;
use App\Repositories\Image\ImageRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class GroupCustomerService
{
    public function getAll()
    {
        return GroupCustomer::all();
    }
}
