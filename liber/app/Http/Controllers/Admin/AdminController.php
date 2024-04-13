<?php

namespace App\Http\Controllers\Admin;
use App\Enums\CriticRequestState;
use App\Http\Controllers\Controller;
use App\Models\CriticRequest;
use App\Models\Movie;
use App\Models\MovieList;
use App\Models\Post;
use App\Models\Report;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller {
    public function index() {
        $admin = auth()->user();
        $totalUsers = User::count();
        $lastMonthUsers = User::where('created_at', '>=', Carbon::now()->subMonth())->count();
        $percentageLastMonthUsers = ($totalUsers > 0) ? ($lastMonthUsers / $totalUsers) * 100 : 0;
        $totalMovies = Movie::count();
        $lastMonthMovies = Movie::where('created_at', '>=', Carbon::now()->subMonth())->count();
        $totalPosts = Post::count();
        $lastMonthPosts = Post::where('created_at', '>=', Carbon::now()->subMonth())->count();
        $totalMovieLists = MovieList::count();
        $lastMonthMovieLists = MovieList::where('created_at', '>=', Carbon::now()->subMonth())->count();
        $totalReports = Report::count();
        $lastMonthReports = Report::where('created_at', '>=', Carbon::now()->subMonth())->count();
        $totalReviews = Review::count();
        $lastMonthReviews = Review::where('created_at', '>=', Carbon::now()->subMonth())->count();

        $topMovies = Movie::withCount('watchedByUsers as number_of_users')
            ->withAvg('ratings as average_rating', 'rating')
            ->withAvg('ratings as critics_average', 'rating')
            ->orderByDesc('number_of_users')
            ->orderByDesc('average_rating')
            ->limit(10)
            ->get();

        return view('admin.admin_panel',
            [
                'admin' => $admin,
                'totalUsers' => $totalUsers,
                'percentageLastMonthUsers' => $percentageLastMonthUsers,
                'totalMovies' => $totalMovies,
                'lastMonthMovies' => $lastMonthMovies,
                'totalPosts' => $totalPosts,
                'lastMonthPosts' => $lastMonthPosts,
                'totalMovieLists' => $totalMovieLists,
                'lastMonthMovieLists' => $lastMonthMovieLists,
                'totalReports' => $totalReports,
                'lastMonthReports' => $lastMonthReports,
                'totalReviews' => $totalReviews,
                'lastMonthReviews' => $lastMonthReviews,
                'topMovies' => $topMovies
            ]);
    }

    public function showCriticApplications(){
        $admin = auth()->user();
        $requests = CriticRequest::paginate(10);

        return view('admin.criticApplications',
            [
                'admin' => $admin,
                'requests' => $requests,
            ]);
    }

    public function updateCriticStatus(Request $request, $id)
    {
        $criticApplication = CriticRequest::find($id);
        $criticApplication->state = $request->input('status');
        $criticApplication->response = $request->input('decision');
        $criticApplication->save();

        $requests = CriticRequest::orderByRaw("FIELD(state, 'pending', 'rejected', 'approved')")
            ->paginate(10);

        if ($request->input('status') == CriticRequestState::Approved->value) {
            $user = User::findOrFail($criticApplication->user_id);
            $user->critic = true;
            $user->save();
        }

        return redirect()->route('admin.applications')->with('success', 'Status updated successfully');
    }
}
