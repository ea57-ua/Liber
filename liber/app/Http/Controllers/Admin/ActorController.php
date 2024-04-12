<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function showActorsAdminPanel(){
        $admin = auth()->user();
        $actors = Actor::paginate(10);
        return view('admin.actors.actorsList'
            , ['admin' => $admin, 'actors' => $actors]);
    }

    public function destroyActor($id){
        $actor = Actor::find($id);
        $actor->delete();
        return redirect()->route('admin.actors');
    }


    public function updateActor(Request $request, $id){
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'photo_url' => 'required|url'
        ]);

        $actor = Actor::find($id);
        $actor->name =  $request->input('name');
        $actor->description = $request->input('description');
        $actor->photo = $request->input('photo_url');
        $actor->save();

        return redirect()->route('admin.actors');
    }

    public function showCreateActor() {
        $admin = auth()->user();
        return view('admin.actors.createActor', ['admin' => $admin]);
    }

    public function createActor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'photoURL' => 'required|url',
        ]);

        $actor = new Actor();
        $actor->name = $request->input('name');
        $actor->description = $request->input('description');
        $actor->photo = $request->input('photoURL');
        $actor->save();

        return redirect()->route('admin.actors')->with('message', 'Actor created successfully');
    }
}
