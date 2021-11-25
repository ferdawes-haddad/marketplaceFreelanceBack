<?php

namespace App\Http\Controllers;

use App\skills;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function getSkills()
    {
        $data = skills::all();
        return $data;
    }

    public function getSkillsById($id)
    {
        $skills = skills::find($id);
        if (is_null($skills)) {
            return response()->json(['message' => 'Ouups!'], 404);
        }
        return response()->json($skills::find($id), 200);
    }

    public function addSkills(Request $request)
    {
        $skills = skills::create($request->all());
        return response($skills, 201);
    }

    public function updateSkills(Request $request, $id) {
        $skills = skills::find($id);
        if(is_null($skills)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $skills->update($request->all());
        return response($skills, 200);
    }

    public function deleteSkills(Request $request, $id) {
        $skills = skills::find($id);
        if(is_null($skills)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $skills->delete();
        return response()->json(null, 204);
    }
}
