<?php

namespace App\Http\Controllers;

use App\cvs;
use Illuminate\Http\Request;

class CvController extends Controller
{
    public function getCV()
    {
        $curriculum = cvs::all();
        return $curriculum;
    }

    public function getall(){
        $test = cvs::with('userName')->get();
        if(is_null($test)){
            return response()->json(['message' => 'Oups'], 404);
        }
        return response()->json($test,200);
    }

    public function getCVById($id)
    {
        $cv = cvs::find($id);
        if (is_null($cv)) {
            return response()->json(['message' => 'Ouups!'], 404);
        }
        return response()->json($cv::find($id), 200);
    }

    public function addCV(Request $request)
    {
        $cv = cvs::create($request->all());
        return response($cv, 201);
    }

    public function updateCV(Request $request, $id) {
        $cv = cvs::find($id);
        if(is_null($cv)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $cv->update($request->all());
        return response($cv, 200);
    }

    public function deleteCV(Request $request, $id) {
        $cv = cvs::find($id);
        if(is_null($cv)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $cv->delete();
        return response()->json(null, 204);
    }
}
