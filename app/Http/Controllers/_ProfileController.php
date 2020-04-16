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
        $teamID = $user->_teamID;
        $team;
        $fitnesslevel = $user->fitnesslevel;
        $totalPoints = $user->points;
        $multiplier = $user->multiplier;
        $fitnesslevelString;

        if($fitnesslevel === 0){
            $fitnesslevelString = "Ich trainiere ab und zu.";
        }
        if($fitnesslevel === 1){
            $fitnesslevelString = "Ich trainiere regelmäßig und bin richtig fit!";
        }

        if($teamID === 1){
            $team = 'Alpha';
        }
        if($teamID === 2){
            $team = 'Beta';
        }

        return view('profile')
                ->with('username', $username)
                ->with('team', $team)
                ->with('fitnesslevelString', $fitnesslevelString)
                ->with('totalPoints', $totalPoints)
                ->with('multiplier', $multiplier);
    }
}
