<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Image\ImageRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class UserService
{
    public function getAll()
    {
        return User::all();
    }
}
