<?php

namespace App\Http\Controllers;

use App\Models\Rentlogs;
use Illuminate\Http\Request;

class RentLogController extends Controller
{
    public function index() 
    {
        $rentlogs = RentLogs::with(['user', 'book'])->get();
        return view ('rentlog', ['rent_logs' => $rentlogs]);
    }
}