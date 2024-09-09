<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function userdashboard()
    {
        return view("user.dashboard");
    }

    public function admindashboard()
    {
        return view("admin.dashboard");
    }

    public function agentdashboard()
    {
        return view("agent.dashboard");
    }
}
