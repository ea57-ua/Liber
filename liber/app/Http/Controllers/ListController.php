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
}
