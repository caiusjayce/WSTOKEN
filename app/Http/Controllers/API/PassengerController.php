<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Passenger;
use Flash;
use Response;

class AirplaneController extends Controller {
    public $successStatus = 200;

    public function getAllAirplanes(Request $request) {
        $token = $request['t']; // t= token
        $passengerid = $request['pa']; // pa= passenger id

        $passenger = Passenger::where('id', $passengerid)->where('remember_token', $token)->first();

        if($passenger !=null) {
            $airplanes = Airplanes::all();

                return response()->json($airplanes, $this->successStatus); 
            } else {
    
            return response()->json(['response' => 'Bad Call'], 501); 
        }
    }

 public function getAirplane(Request $request) {
        $id = $request['pid']; // pid= post id
        $token = $request['t']; // t= token
        $passengerid = $request['pa']; // pa= passenger id

        $passenger = Passenger::where('id', $passengerid)->where('remember_token', $token)->first();

        if($passenger !=null) {
            $airplane = Airplanes::where('id', $id)->first();

            if ($airplane !=null){
                return response()->json($airplane, $this->successStatus); 
            } else {
                return response()->json(['response' => 'Airplane not found!'], 404); 
            }

        } else {
            return response()->json(['response' => 'Bad Call'], 501); 
        }

    }

    public function searchAirplane(Request $request) {
        $params = $request['p']; // p= params
        $token = $request['t']; // t= token
        $passengerid = $request['pa']; // pa = passenger id

        $passenger = Passenger::where('id', $passengerid)->where('remember_token', $token)->first();

        if($passenger !=null) {
            $airplane = Airplanes::where('airplanename', 'LIKE', '&' .  $params . '&')
                ->orWhere('title', 'LIKE', '&' .  $params . '&')
                ->get();
                // SELECT * FROM airplane WHERE airplanename LIKE '%params%' OR title LIKE '%params%'
            if ($airplane !=null){
                return response()->json($airplane, $this->successStatus); 
            } else {
                return response()->json(['response' => 'Airplane not found!'], 404); 
            }

        } else {
            return response()->json(['response' => 'Bad Call'], 501); 
        }

    }
}