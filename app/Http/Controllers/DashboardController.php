<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data["status"] = Tickets::count();

        $data["statusOpen"] = Tickets::where("status", "Open")->count();
        $data["statusClosed"] = Tickets::where("status", "Close")->count();

        return view("Admin.dashboard", $data);
    }
}
