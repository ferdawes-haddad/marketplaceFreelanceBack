<?php

namespace App\Http\Controllers;

use App\skills_emplois;
use Illuminate\Http\Request;

class skillsEmploisController extends Controller
{
    public function getSkyles()
    {
        $data = skills_emplois::all();
        return $data;
    }

    public function getSkylesById($id)
    {
        $skyles = skills_emplois::find($id);
        if (is_null($skyles)) {
            return response()->json(['message' => 'Ouups!'], 404);
        }
        return response()->json($skyles::find($id), 200);
    }

    public function getTitreSkylesTechnique($type)
    {
        $skyles = skills_emplois::where('type', 'technique')
            ->select('titre')
            ->get();
        if (is_null($skyles)) {
            return response()->json(['message' => 'Ouups!'], 404);
        }
        return response()->json($skyles, 200);
    }
    public function getSkylesTechnique($type)
    {
        $skyles = skills_emplois::where('type', 'technique')->get();
        if (is_null($skyles)) {
            return response()->json(['message' => 'Ouups!'], 404);
        }
        return response()->json($skyles, 200);
    }

    public function getSkylesFonctionnel($type)
    {
        $skyles = skills_emplois::where('type', 'fonctionnel')->get();
        if (is_null($skyles)) {
            return response()->json(['message' => 'Ouups!'], 404);
        }
        return response()->json($skyles, 200);
    }

    public function addSkyles(Request $request)
    {
        $skyles = skills_emplois::create($request->all());
        return response($skyles, 201);
    }

    public function updateSkyles(Request $request, $id) {
        $skyles = skills_emplois::find($id);
        if(is_null($skyles)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $skyles->update($request->all());
        return response($skyles, 200);
    }

    public function deleteSkyles(Request $request, $id) {
        $skyles = skills_emplois::find($id);
        if(is_null($skyles)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $skyles->delete();
        return response()->json(null, 204);
    }
}
