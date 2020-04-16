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
        $fitnesslevel = $user->fitnesslevel;
        $fitnesslevelString;

        if($fitnesslevel === 0){
            $fitnesslevelString = "Ich trainiere ab und zu.";
        }
        if($fitnesslevel === 1){
            $fitnesslevelString = "Ich trainiere regelmäßig und bin richtig fit!";
        }

        return view('profile')
                ->with('username', $username)
                ->with('fitnesslevelString', $fitnesslevelString);
    }
}
