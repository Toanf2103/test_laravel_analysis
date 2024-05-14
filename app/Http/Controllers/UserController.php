<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        return view('index', compact('users'));
    }

    public function users(Request $rq)
    {
        $users = User::select(['*']);
        return Datatables::of($users)
            ->addIndexColumn()
            ->make(true);
    }
}
