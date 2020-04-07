<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class _MultiplierController extends Controller
{
    public function defineNewMultiplier($user){
        $lastWorkoutIsValide = $this->checkIfLastWorkoutIsValid($user);
        if($lastWorkoutIsValide){
            $multiplier = $this->calculateMultiplier($user);
            return $multiplier;
        }
    }

    private function checkIfLastWorkoutIsValid($user){
        if($user->lastWorkout > now()){
            return false;
        }
        if($user->lastWorkout === null){
            return false;
        }
        return true;
    }

    private function calculateMultiplier($user){
        $differenceInDays = $this->calculateDifferenceInDays($user);
        if($differenceInDays > 2){
            $multiplier = 1;
        }elseif($differenceInDays <= 2 && $user->multiplier < 5){
            $multiplier = $user->multiplier + 0.2;
        }elseif($differenceInDays <= 2 && $user->multiplier >= 5){
            $multiplier = 5;
        }
        var_dump($multiplier);
        return $multiplier;
    }

    private function calculateDifferenceInDays($user){
        $difference = now()->diff($user->lastWorkout);
        $differenceInDays = (int)$difference->format('%a');
        return $differenceInDays;
    }
}
