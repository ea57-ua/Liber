@extends('layouts.admin')
@section('content')


<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
        </ol>
    </nav>
</div>

<section class="section dashboard">
    <div class="row">
         <!-- Users Card -->
         <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

                <div class="card-body">
                    <h5 class="card-title">Users <span> Registered </span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$totalUsers}}</h6>
                            <span class="text-success small pt-1 fw-bold">{{$percentageLastMonthUsers}}%</span> <span
                                class="text-muted small pt-2 ps-1">increase since last month</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Movies Card -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">

                <div class="card-body">
                    <h5 class="card-title">Movies <span></span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class='bx bx-movie'></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$totalMovies}}</h6>
                            <span class="text-success small pt-1 fw-bold">{{$lastMonthMovies}}%</span> <span
                                class="text-muted small pt-2 ps-1">new films</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Posts Card -->
        <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

                <div class="card-body">
                    <h5 class="card-title">Forum <span> Posts</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class='bx bx-message-square' ></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$totalPosts}}</h6>
                            <span class="text-danger small pt-1 fw-bold">{{$lastMonthPosts}}</span> <span
                                class="text-muted small pt-2 ps-1">new posts last 30 days</span>

                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Lists Card -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

                <div class="card-body">
                    <h5 class="card-title">Movie <span> Lists </span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class='bx bx-list-ul'></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$totalMovieLists}}</h6>
                            <span class="text-success small pt-1 fw-bold">{{$lastMonthMovieLists}}</span> <span
                                class="text-muted small pt-2 ps-1">new lists created</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Reports Card -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">

                <div class="card-body">
                    <h5 class="card-title"> Reports <span>User and Post</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class='bx bxs-report' ></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$totalReports}}</h6>
                            <span class="text-success small pt-1 fw-bold">{{$lastMonthReports}}%</span> <span
                                class="text-muted small pt-2 ps-1">new reports</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Reviews Card -->
        <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

                <div class="card-body">
                    <h5 class="card-title">Reviews <span> Written</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class='bx bx-message-rounded-edit'></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$totalReviews}}</h6>
                            <span class="text-danger small pt-1 fw-bold">{{$lastMonthReviews}}</span> <span
                                class="text-muted small pt-2 ps-1">new reviews last month</span>

                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Top Movies -->
        <div class="col-12">
            <div class="card top-selling overflow-auto">

                <div class="card-body pb-0">
                    <h5 class="card-title">Top Movies <span></span></h5>

                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">Movie title</th>
                            <th scope="col" class="text-center">Users watched</th>
                            <th scope="col" class="text-center">Average rating</th>
                            <th scope="col" class="text-center">Critics average</th>
                            <th scope="col" class="text-center">Review's number</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($topMovies as $movie)
                            <tr>
                                <td class="text-center"><a href="#" class="text-primary fw-bold">{{ $movie->title }}</a></td>
                                <td class="text-center">{{ $movie->watchedByUsers->count() ?: 'No Data' }}</td>
                                <td class="text-center">{{ $movie->average_rating ?: 'No Data' }}</td>
                                <td class="text-center">{{ $movie->getCriticAverageAttribute() ?: 'No Data' }}</td>
                                <td class="text-center">{{ $movie->reviews->count() ?: 'No Data' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
