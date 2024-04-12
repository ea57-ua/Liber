<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Director;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function showDirectorsAdminPanel(){
        $admin = auth()->user();
        $directors = Director::paginate(10);
        return view('admin.directors.directorsList',
            ['admin' => $admin,
                'directors' => $directors]);
    }

    public function destroyDirector($id){
        $director = Director::find($id);
        $director->delete();
        return redirect()->route('admin.directors');
    }

    public function updateDirector(Request $request, $id){
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'photo_url' => 'required|url'
        ]);

        $director = Director::find($id);
        $director->name =  $request->input('name');
        $director->description = $request->input('description');
        $director->photo = $request->input('photo_url');
        $director->save();

        return redirect()->route('admin.directors');
    }

    public function showCreateDirector() {
        $admin = auth()->user();
        return view('admin.directors.createDirector', ['admin' => $admin]);
    }

    public function createDirector(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'photoURL' => 'required|url',
        ]);

        $director = new Director();
        $director->name = $request->input('name');
        $director->description = $request->input('description');
        $director->photo = $request->input('photoURL');
        $director->save();

        return redirect()->route('admin.directors')->with('message', 'Director created successfully');
    }
}
