@extends('layouts.admin')
@section('content')
    <div class="pagetitle">
        <h1>Movie Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.movies')}}">Movies</a></li>
                <li class="breadcrumb-item active">Movie Details</li>
            </ol>
        </nav>
    </div>


    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="{{$movie->posterURL}}" alt="Profile">
                        <h2>{{$movie->title}}</h2>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">
                                    Information
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Information</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Synopsis</h5>
                                <p class="small fst-italic">
                                    {{$movie->synopsis}}
                                </p>

                                <h5 class="card-title">Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Title</div>
                                    <div class="col-lg-9 col-md-8">
                                        <strong>
                                        <a href="{{route('movies.details', $movie->id)}}">
                                            {{$movie->title}}
                                        </a>
                                        </strong>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Directors</div>
                                    <div class="col-lg-9 col-md-8">
                                        @foreach($movie->directors as $key => $director)
                                            <a href="{{route('directors.details', $director->id)}}">
                                                <strong>{{$director->name}}</strong>
                                            </a>{{ $key < count($movie->directors) - 1 ? ',' : '' }}
                                        @endforeach
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Genres</div>
                                    <div class="col-lg-9 col-md-8">
                                        @foreach($movie->genres as $key => $genre)
                                                <strong>{{$genre->name}}</strong>
                                         {{ $key < count($movie->genres) - 1 ? ',' : '' }}
                                        @endforeach
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Actors</div>
                                    <div class="col-lg-9 col-md-8">
                                        @foreach($movie->actors as $key => $actor)
                                            <a href="{{route('actors.details', $actor->id)}}">
                                                <strong>{{$actor->name}}</strong>
                                            </a>
                                            {{ $key < count($movie->actors) - 1 ? ',' : '' }}
                                        @endforeach
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Countries</div>
                                    <div class="col-lg-9 col-md-8">
                                        @foreach($movie->countries as $key => $country)
                                            <strong>{{$country->name}}</strong>
                                            {{ $key < count($movie->countries) - 1 ? ',' : '' }}
                                        @endforeach
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Streaming services</div>
                                    <div class="col-lg-9 col-md-8">
                                        @foreach($movie->streamingServices as $key => $service)
                                            <strong>{{$service->name}}</strong>
                                            {{ $key < count($movie->streamingServices) - 1 ? ',' : '' }}
                                        @endforeach
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Release date</div>
                                    <div class="col-lg-9 col-md-8">{{$movie->releaseDate}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Trailer URL</div>
                                    <div class="col-lg-9 col-md-8">
                                        <a href="{{$movie->trailer_link}}">
                                        {{$movie->trailer_link}}
                                        </a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Poster URL</div>
                                    <div class="col-lg-9 col-md-8">{{$movie->posterURL}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Background Image URL</div>
                                    <div class="col-lg-9 col-md-8">{{$movie->background_image_link}}</div>
                                    <div class="d-flex justify-content-center">
                                        <img src="{{$movie->background_image_link}}"
                                             class="mt-3 mb-3"
                                             alt="Background Image"
                                             style="width: 500px; height: auto;">
                                    </div>

                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form>
                                    <div class="row mb-3">
                                        <label for="title" class="col-md-4 col-lg-3 col-form-label">Movie title</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="title" type="text" class="form-control" id="title" value="{{$movie->title}}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="synopsis" class="col-md-4 col-lg-3 col-form-label">Synopsis</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea name="synopsis" class="form-control"
                                                      id="synopsis" style="height: 100px">{{$movie->synopsis}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="relaseDate" class="col-md-4 col-lg-3 col-form-label">Release Date</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="relaseDate" type="date" class="form-control" id="relaseDate"
                                                   value="{{$movie->releaseDate}}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="trailerURL" class="col-md-4 col-lg-3 col-form-label">Trailer URL</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="trailerURL" type="text"
                                                   class="form-control" id="trailerURL"
                                                   value="{{$movie->trailer_link}}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="posterURL" class="col-md-4 col-lg-3 col-form-label">Poster</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="posterURL" type="text"
                                                   class="form-control" id="posterURL"
                                                   value="{{$movie->posterURL}}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="backgroundImage" class="col-md-4 col-lg-3 col-form-label">Background image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="backgroundImage" type="text"
                                                   class="form-control" id="backgroundImage"
                                                   value="{{$movie->background_image_link}}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img src="assets/img/profile-img.jpg" alt="Profile">
                                            <div class="pt-2">
                                                <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-settings">

                                <!-- Settings Form -->
                                <form>

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="changesMade" checked>
                                                <label class="form-check-label" for="changesMade">
                                                    Changes made to your account
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="newProducts" checked>
                                                <label class="form-check-label" for="newProducts">
                                                    Information on new products and services
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="proOffers">
                                                <label class="form-check-label" for="proOffers">
                                                    Marketing and promo offers
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                                                <label class="form-check-label" for="securityNotify">
                                                    Security alerts
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End settings Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form>

                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control" id="currentPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword" type="password" class="form-control" id="newPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
