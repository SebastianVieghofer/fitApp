<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;

class _TeamController extends Controller
{
    public function organizeTeamsOnRegristation(){
        $numberOfTeamBlueMembers = User::all()->where('_teamID' , 1)->count();
        $numberOfTeamRedMembers = User::all()->where('_teamID' , 2)->count();

        if($numberOfTeamBlueMembers < $numberOfTeamRedMembers){
            return 1;
        }
        if($numberOfTeamBlueMembers > $numberOfTeamRedMembers){
            return 2;
        }
        if($numberOfTeamBlueMembers === $numberOfTeamRedMembers){
            return 1;
        }
    }
}
