<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Push;
use App\Pull;
use App\Leg;
use App\BackCore;
use App\User;
use Auth;

class _WorkoutController extends Controller
{
    public function randomWorkout(){
        $user = Auth::user();
        $fitnesslevel = $user->fitnesslevel;
        $fitnesslevelString;
        $multiplier = $user->multiplier;
        if($fitnesslevel === 0){
            $fitnesslevelString = 'Leicht';
        }else{
            $fitnesslevelString = 'Anspruchsvoll';
        }
        if($user->fitnesslevel == 0){
            
            $randomPush = Push::all()->where('fitnesslevel' , 0)->random();
            $randomPull = Pull::all()->where('fitnesslevel' , 0)->random();
            $randomLeg = Leg::all()->where('fitnesslevel' , 0)->random();
            $randomBackCore = BackCore::all()->random();
            
            return view('workout')
                ->with('fitnesslevelString', $fitnesslevelString)
                ->with('randomPush', $randomPush)
                ->with('randomPull', $randomPull)
                ->with('randomLeg', $randomLeg)
                ->with('randomBackCore', $randomBackCore)
                ->with('multiplier', $multiplier);
        }
        if($user->fitnesslevel == 1){
            $randomPush = Push::all()->where('fitnesslevel' , 1)->random();
            $randomPull = Pull::all()->where('fitnesslevel' , 1)->random();
            $randomLeg = Leg::all()->where('fitnesslevel' , 1)->random();
            $randomBackCore = BackCore::all()->random();
            
            return view('workout')
                ->with('fitnesslevelString', $fitnesslevelString)
                ->with('randomPush', $randomPush)
                ->with('randomPull', $randomPull)
                ->with('randomLeg', $randomLeg)
                ->with('randomBackCore', $randomBackCore)
                ->with('multiplier', $multiplier);
        }
    }
}
