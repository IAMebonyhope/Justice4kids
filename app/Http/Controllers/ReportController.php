<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAuthRequest;
use App\User;
use App\Report;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ReportController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function getReport($id){

        $roles = unserialize($this->user->role);

        if(in_array("advocate", $roles)){
            return response()->json([
                'success' => false,
                'message' => "No enough permission to perform this operation"
            ], 500);
        }
       
        $report = Report::where([
            ['id', '=', $id],
        ])->first();

        if ($report != null){

            $report->tags = unserialize($report->tags);
            $report->watcherIDs = unserialize($report->watcherIDs);
            return response()->json([
                'success' => false,
                'data' => $report
            ], 200);
        }          
        else{
            return response()->json([
                'success' => false,
                'message' => 'Report not found',
            ], 401);
        }
            

    }

    public function getAllReport(){
        if($this->user->role !== "superadmin"){
            return response()->json(['error' => true, 'msg' => "No enough permission to perform this operation"]);
        }
    }

    public function acceptReport(){

    }
}
