<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ReportState;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Report;
use App\Models\User;
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


    public function resolveReport(Request $request, $id)
    {
        $action = $request->input('action');
        $report = Report::findOrFail($id);
        $reportedUser = User::findOrFail($report->post->user_id);
        $reportedPost = Post::findOrFail($report->post_id);

        switch ($action) {
            case 'delete_post':
                Post::destroy($report->post_id);
                break;
            case 'block_user':
                // Block the user
                break;
            case 'delete_post_and_block_user':
                // Delete the post and block the user
                break;
            case 'nothing':
                // Do nothing
                break;
        }

        $report->state = ReportState::Resolved;
        return redirect()->route('admin.reports');
    }
}
