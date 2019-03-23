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

        if(in_array("advocate", $roles) == false){
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
                'success' => true,
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

    public function getAllReports(){
        $roles = unserialize($this->user->role);

        if(in_array("advocate", $roles) == false){
            return response()->json([
                'success' => false,
                'message' => "No enough permission to perform this operation"
            ], 500);
        }

        $reports = Report::all()->toArray();

        if ($reports != null){

            foreach($reports as $report){
                $report->tags = unserialize($report->tags);
                $report->watcherIDs = unserialize($report->watcherIDs);
            }
            
            return response()->json([
                'success' => true,
                'data' => $reports
            ], 200);
        }          
        else{
            return response()->json([
                'success' => false,
                'message' => 'Reports not found',
            ], 401);
        }

    }

    public function acceptReport(Request $request){

        $roles = unserialize($this->user->role);

        if(in_array("advocate", $roles)){
            return response()->json([
                'success' => false,
                'message' => "No enough permission to perform this operation"
            ], 500);
        }

        $validator = Validator::make($request->all(), [
            'reportID' => 'required|string',   
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data' => $validator->errors()
            ], 500);
        }

        $report = new Report();
        $report->title = $request->title;
        $report->description = $request->description;
        $report->address = $request->address;
        $report->state = $request->state;
        $report->country = $request->country;
        $report->status = "Pending";
        $report->tags = serialize(json_decode($request->tags));
        $report->personInvolvedIDs = serialize($personIDs);
        
        
        if($report->save()){
            return response()->json([
                'success' => true,
                'data' => $report
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => "error creating report"
            ], 500);
        }
    }
}
