<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View; 

class FollowController extends Controller
{

    public function follow(User $user){
        $currentUser = Auth::user();

        if (!$currentUser->following()->where('followed_id', $user->id)->exists()){
            $currentUser->following()->attach($user->id);
        }
        return redirect()->back();
    }

    public function unfollow(User $user){
        $currentUser = Auth::user();

        if ($currentUser->following()->where('followed_id', $user->id)->exists()) {
            $currentUser->following()->detach($user->id);
        }
        return redirect()->back();
    }
    /**
     * Display a listing of the resource.
     */
    public function following(): View
    {
        return View('following.index', ['follows'=> Auth::user()->following()->get()]);
    }
    public function followers(): View
    {
        return View('followers.index', ['followers'=> Auth::user()->followers()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Follow $follow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Follow $follow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Follow $follow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Follow $follow)
    {
        //
    }
}
