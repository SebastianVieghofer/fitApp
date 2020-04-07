<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class _ProfileController extends Controller
{
    public function generateProfilePageData(){
        $user = Auth::user();
        $username = $user->name;
        $totalPoints = $user->points;
        $multiplier = $user->multiplier;

        return view('profile')
                ->with('username', $username)
                ->with('totalPoints', $totalPoints)
                ->with('multiplier', $multiplier);
    }
}
