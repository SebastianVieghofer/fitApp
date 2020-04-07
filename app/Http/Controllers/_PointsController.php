<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class _PointsController extends Controller
{
    public function calculatePoints($user){
        $user = Auth::user();
        $AVERAGEPOINTS = 200;
        $multiplier = $user->multiplier;

        $totalPoints = $AVERAGEPOINTS * $multiplier;

        return $totalPoints;
    }
}
