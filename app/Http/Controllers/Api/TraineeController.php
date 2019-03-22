<?php

namespace App\Http\Controllers\Api;
use App\Trainee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TraineeResource;
class TraineeController extends Controller
{
    public function index()
    {
        // die();
        return TraineeResource::collection(Trainee::all());//see all posts
        // return TraineeResource::collection($trainee);//select only 3
     
    } 
    public function show($trainee)
    {
        // dd($trainee);
        $trainee=Trainee::findOrFail($trainee);
        return new TraineeResource($trainee);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        Trainee::create($request->all());
        
        return response()->json([
            'message' => 'trainee Created Successfully'
        ],201);
    }

    public function destroy(trainee $trainee)
    {
        $trainee->delete();
        return response()->json([
            'message' => 'delete Successfully'
        ]);
    }
}