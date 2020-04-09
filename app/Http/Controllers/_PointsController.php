<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class _PointsController extends Controller
{
    public function calculatePoints($user){
        $user = Auth::user();
        $multiplierController = new _MultiplierController;
        $multiplier = $multiplierController->returnMultiplierAccordingToLastWorkout($user);
        $AVERAGEPOINTS = 200;
        
        $totalPoints = $AVERAGEPOINTS * $multiplier;

        return $totalPoints;
    }
}
