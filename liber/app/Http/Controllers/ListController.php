<?php

namespace App\Http\Controllers;

use App\Models\MovieList;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function listDetailsShow(Request $request, $id)
    {
        $list = MovieList::findOrFail($id);
        $creator = $list->user;
        $movies = $list->movies;
        $movies->load('genres');
        $genres = $movies->pluck('genres')->flatten(1)->unique('id');
        $likesCount = $list->likedByUsers()->count();

        return view('lists.listDetails',
            [
                'list' => $list,
                'creator' => $creator,
                'movies' => $movies,
                'genres' => $genres,
                'likesCount' => $likesCount,
            ]
        );
    }

    public function createList(Request $request)
    {
        $request->validate([
            'listName' => 'required|max:255',
            'listDescription' => 'nullable',
            'listImage' => 'nullable|image',
        ]);

        $list = new MovieList;
        $list->name = $request->listName;
        $list->description = $request->listDescription;
        $list->public = $request->has('isPublic');
        $list->watchlist = $request->has('isWatchlist');
        $list->user_id = $request->user()->id;

        if ($request->has('listImage')) {
            $extension = $request->listImage->getClientOriginalExtension();
            $filename = $list->name . '_list.' . $extension;
            $request->listImage->move(public_path('images/list_images'), $filename);
            $list->poster_image = '/images/list_images/' . $filename;
        }

        $list->save();
        return redirect()->route('lists.details', $list->id);
    }

    public function toggleLike(Request $request, $id)
    {
        $list = MovieList::findOrFail($id);
        $user = $request->user();

        if ($list->likedByUsers->contains($user)) {
            $list->likedByUsers()->detach($user);
        } else {
            $list->likedByUsers()->attach($user);
        }

        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'public' => 'boolean',
            'watchlist' => 'boolean',
            'poster_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $list = MovieList::findOrFail($id);

        if ($request->hasFile('poster_image')) {
            $extension = $request->poster_image->getClientOriginalExtension();
            $imageName = time().$list->name.'.'.$extension;
            $request->poster_image->move(public_path('images/list_images'), $imageName);
            $list->poster_image =  '/images/list_images/' . $imageName;;
        }

        $list->name = $request->name;
        $list->description = $request->description;
        $list->public = $request->has('public');
        $list->watchlist = $request->has('watchlist');
        $list->save();

        return redirect()->route('lists.details', $id);
    }

    public function listsPage(Request $request)
    {
        return view('lists.listsPage');
    }
}
