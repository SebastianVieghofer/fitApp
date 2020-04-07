<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class _TeamController extends Controller
{
    public function organizeTeamsOnRegristation(){
        $numberOfTeamBlueMembers = User::all()->where('_teamID' , 1)->count();
        $numberOfTeamRedMembers = User::all()->where('_teamID' , 2)->count();

        var_dump($numberOfTeamBlueMembers);
        var_dump($numberOfTeamRedMembers);

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
