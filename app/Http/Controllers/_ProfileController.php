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
            $fitnesslevelString = "Anfänger";
        }
        if($fitnesslevel === 1){
            $fitnesslevelString = "Fortgeschritten";
        }

        return view('profile')
                ->with('username', $username)
                ->with('fitnesslevelString', $fitnesslevelString);
    }
}
