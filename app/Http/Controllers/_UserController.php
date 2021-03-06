<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class _UserController extends Controller
{
    public function updateOne(Request $request){
        $requestArray = $request->all();
        $user = Auth::user();
        $user->fitnesslevel = $requestArray['fitnesslevel'];
        $user->save();
        return redirect()->to('/'); 
    }
}
