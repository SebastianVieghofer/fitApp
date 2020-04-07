<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function updateFitnessLevel(Request $request) {
        $uc = new _UserController();
        return $uc->updateFitnessLevel($request);
    }

    public function updateAfterWorkoutCompleted() {
        $uc = new _UserController();
        return $uc->updateAfterWorkoutCompleted();
    }    
}
