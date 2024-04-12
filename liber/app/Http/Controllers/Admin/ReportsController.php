<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function showReportsAdminPanel(){
        $admin = auth()->user();
        return view('admin.reports.reportsList',
            ['admin' => $admin]);
    }
}
