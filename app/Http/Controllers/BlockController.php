<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlockController extends Controller
{
    public function block(User $user)
    {
        $currentUser = Auth::user();

        if (!$currentUser->hasBlocked($user)) {
            $currentUser->following()->detach($user->id);
            $currentUser->blockedUsers()->attach($user->id);
        }

        return redirect()->back()->with('status', 'Usuario bloqueado exitosamente.');
    }

    public function unblock(User $user)
    {
        $currentUser = Auth::user();

        if ($currentUser->hasBlocked($user)) {
            $currentUser->blockedUsers()->detach($user->id);
        }

        return redirect()->back()->with('status', 'Usuario desbloqueado exitosamente.');
    }

    public function blocked(): View
    {
        return View('blocked.index', ['blockedUsers'=> Auth::user()->blockedUsers()->get()]);
    }}
