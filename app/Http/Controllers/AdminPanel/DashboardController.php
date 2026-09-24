<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function DashboardPage()
    {
        $data['title'] = 'Dashboard';

        return view('adminpanel.dashboard', $data);
    }
}
