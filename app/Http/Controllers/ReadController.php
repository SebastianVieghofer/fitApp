<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ReadController extends Controller
{
    public function selectRandomWorkout() {
        $wc = new _WorkoutController();
        return $wc->randomWorkout();
    }

    public function displayGeneratedProfilePageData() {
        $pc = new _ProfileController();
        return $pc->generateProfilePageData();
    }
}
