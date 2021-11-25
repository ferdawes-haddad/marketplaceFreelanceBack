<?php

namespace App\Http\Controllers;

use App\Emplois;
use App\skills_emplois;
use Illuminate\Http\Request;

class EmploisSkylesController extends Controller
{
    public function getEmploisSkyles()
    {
        $data = skills_emplois::all();
        return $data;
    }

    public function getEmploisSkylesById($id)
    {
        $emploisSkyles = skills_emplois::find($id)->select('titre')->get();;
        if (is_null($emploisSkyles)) {
            return response()->json(['message' => 'Ouups!'], 404);
        }
        return response()->json($emploisSkyles::find($id), 200);
    }

    public function ajoutEmploisSkyles(Request $request)
    {
        $emploisSkyles = skills_emplois::create($request->all());
        return response($emploisSkyles, 201);
    }

    public function updateEmploisSkyles(Request $request, $id) {
        $emploisSkyles = skills_emplois::find($id);
        if(is_null($emploisSkyles)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $emploisSkyles->update($request->all());
        return response($emploisSkyles, 200);
    }

    public function deleteEmploisSkyles(Request $request, $id) {
        $emploisSkyles = skills_emplois::find($id);
        if(is_null($emploisSkyles)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $emploisSkyles->delete();
        return response()->json(null, 204);
    }

    public function getEmploisBySkills(){
        $result = Emplois::join('competence_emplois', 'emplois.id', '=', 'competence_emplois.emplois_id')
            ->join('skills_emplois', 'competence_emplois.skills_emplois_id', '=', 'skills_emplois.id')
            ->select('competence_emplois.*', 'emplois.titre', 'skills_emplois.titre')
            ->get();
        return $result;
    }
}
