<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function showReportsAdminPanel(){
        $admin = auth()->user();
        $reports = Report::paginate(10);
        return view('admin.reports.reportsList',
            ['admin' => $admin,
                'reports' => $reports]);
    }
}
