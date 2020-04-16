<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function updateUser(Request $request) {
        $uc = new _UserController();
        return $uc->updateOne($request);
    }

    public function updateAfterWorkoutCompleted() {
        $uc = new _UserController();
        return $uc->updateAfterWorkoutCompleted();
    }
}
