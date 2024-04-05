<?php

namespace App\Http\Controllers;

use App\Models\MovieList;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function listDetailsShow(Request $request, $id)
    {
        $list = MovieList::findOrFail($id);
        return view('lists.listDetails',
            [
                'list' => $list,
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
        $list->user_id = $request->user()->id;

        if ($request->has('listImage')) {
            $extension = $request->listImage->getClientOriginalExtension();
            $filename = $list->name . '_list.' . $extension;
            $request->image->move(public_path('images/list_images'), $filename);
            $list->poster_image = '/images/list_images/' . $filename;
        }

        $list->save();
        return redirect()->route('lists.details', $list->id);
    }
}
