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

    public function provideTeamsData(){
        $user = Auth::user();
        $userTeamID = $user->_teamID;
        $enemyTeamID = $this->getEnemyID($userTeamID);

        $teamData = $this->provideTeamData($userTeamID);
        $teamTotalPoints = $this->calculateTotalPointsForTeam($userTeamID);
        $enemyTotalPoints = $this->calculateTotalPointsForTeam($enemyTeamID);

        $numberOfTeamMates = User::all()->where('_teamID' , $userTeamID)->count();
        $numberOfEnemys = User::all()->where('_teamID' , $enemyTeamID)->count();

        return $this->returnTeamView($teamData, $teamTotalPoints, $enemyTotalPoints, $numberOfTeamMates, $numberOfEnemys);
    }

    private function provideTeamData($teamID){
        $allUsersFromTeam = User::all()->where('_teamID' , $teamID);
        $team = [];
        foreach($allUsersFromTeam as $oneUser){
            $team[] = $oneUser;
        } 
        return $team;
    }

    private function getEnemyID($teamID){
        $queryForEnemyID = DB::table('users')
            ->join('teams', 'users._teamID', '=', 'teams.id')
            ->select('teams._enemyID')
            ->where('_teamID' , $teamID)
            ->first();

        return $queryForEnemyID->_enemyID;
    } 

    private function calculateTotalPointsForTeam($teamID){
        $allUsersFromTeam = User::all()->where('_teamID' , $teamID);
        $totalPoints = 0;
        foreach($allUsersFromTeam as $oneUser){
            $totalPoints += $oneUser->points;
        } 
        return $totalPoints;
    }

    private function returnTeamView($teamData, $teamTotalPoints, $enemyTotalPoints, $numberOfTeamMates, $numberOfEnemys){
        return view('teams')
                ->with('teamData', $teamData)
                ->with('teamTotalPoints', $teamTotalPoints)
                ->with('enemyTotalPoints', $enemyTotalPoints)
                ->with('numberOfTeamMates', $numberOfTeamMates)
                ->with('numberOfEnemys', $numberOfEnemys);
    }
}
