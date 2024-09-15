<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::with(['ticket', 'user'])->orderBy('created_at', 'desc')->paginate(10);
        return view('logs.index', compact('logs'));
    }
}