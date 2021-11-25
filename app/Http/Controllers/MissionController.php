<?php

namespace App\Http\Controllers;

use App\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function getMission()
    {
        $data = Mission::all();
        return $data;
    }

    public function getMissionById($id)
    {
        $mission = Mission::find($id);
        if (is_null($mission)) {
            return response()->json(['message' => 'Ouups!'], 404);
        }
        return response()->json($mission::find($id), 200);
    }

    public function addMission(Request $request)
    {
        $mission = Mission::create($request->all());
        return response($mission, 201);
    }

    public function updateMission(Request $request, $id) {
        $mission = Mission::find($id);
        if(is_null($mission)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $mission->update($request->all());
        return response($mission, 200);
    }

    public function deleteMission(Request $request, $id) {
        $mission = Mission::find($id);
        if(is_null($mission)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $mission->delete();
        return response()->json(null, 204);
    }

}
