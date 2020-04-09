<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class _MultiplierController extends Controller
{
    private function checkIfLastWorkoutIsValid($user){
        if($user->lastWorkout > now()){
            return false;
        }
        return true;
    }

    private function calculateDifferenceInDays($user){
        if($user->lastWorkout === null){
            $user->lastWorkout = now();   
        }
        $difference = now()->diff($user->lastWorkout);
        $differenceInDays = (int)$difference->format('%a');
        return $differenceInDays;
    }
    
    public function returnMultiplierAccordingToLastWorkout($user){
        $lastWorkoutIsValide = $this->checkIfLastWorkoutIsValid($user);
        if($lastWorkoutIsValide){
            $multiplier = $this->setMultiplierAccordingToLastWorkout($user);
            return $multiplier;
        }
    }
    
    private function setMultiplierAccordingToLastWorkout($user){
        $differenceInDays = $this->calculateDifferenceInDays($user);
        if($differenceInDays > 2){
            $multiplier = 1;
        }elseif($differenceInDays <= 2){
            $multiplier = $user->multiplier;
        }
        return $multiplier;
    }
    
    public function newMultiplierAfterWorkout($user){
        $oldMultiplier = $this->returnMultiplierAccordingToLastWorkout($user);
        $newMultiplier = $this->calculateNewMultiplier($oldMultiplier);
        return $newMultiplier;
    }
    
    private function calculateNewMultiplier($multiplier){
        if($multiplier < 5){
            $multiplier += 0.2;
        }elseif($multiplier >= 5){
            $multiplier = 5;
        }
        return $multiplier;
    }
}
