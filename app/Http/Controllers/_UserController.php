<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class _UserController extends Controller
{
    public function updateFitnessLevel(Request $request){
        $requestArray = $request->all();
        $user = Auth::user();
        $user->fitnesslevel = $requestArray['fitnesslevel'];
        $user->save();
        return redirect()->to('/'); 
    }

    public function updateAfterWorkoutCompleted(){
        $pointsController = new _PointsController;
        $multiplierController = new _MultiplierController;
        $user = Auth::user();

        $totalPoints = $pointsController->calculatePoints($user);
        $user->points += $totalPoints;
        
        $newMultiplier = $multiplierController->newMultiplierAfterWorkout($user);
        $user->multiplier = $newMultiplier;

        $user->workoutCounter = $user->workoutCounter + 1;

        $user->lastWorkout = now();

        $user->save();
    }
}
