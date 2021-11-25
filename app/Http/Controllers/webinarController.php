<?php

namespace App\Http\Controllers;

use App\webinars;
use Illuminate\Http\Request;

class webinarController extends Controller
{
    /*public function getWebinar()
    {
        $eve = webinars::all();
        return $eve;
    }*/

    public function getWebinar(){
        $test = webinars::with('usersName')->get();
        if(is_null($test)){
            return response()->json(['message' => 'Oups'], 404);
        }
        return response()->json($test,200);
    }

    public function getWebinarById($id)
    {
        $eve = webinars::find($id);
        if (is_null($eve)) {
            return response()->json(['message' => 'Ouups!'], 404);
        }
        return response()->json($eve::find($id), 200);
    }

    public function addEvenement(Request $request)
    {
        $webinar = new webinars();

        $webinar->titre = $request->titre;
        $webinar->date = $request->date;
        $webinar->user_id = $request->user_id;

        $webinar->save();
        return response()->json(["message" => "Webinar enregistrer avec seccus", $webinar, 201]);

        //$eve = webinars::create($request->all());
        //return response($eve, 201);
    }

    public function updateWebinar(Request $request, $id) {
        $eve = webinars::find($id);
        if(is_null($eve)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $eve->update($request->all());
        return response($eve, 200);
    }

    public function deleteWebinar(Request $request, $id) {
        $eve = webinars::find($id);
        if(is_null($eve)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $eve->delete();
        return response()->json(null, 204);
    }

    public function getallWebinar(){
        $test = webinars::with('userName')->get();
        if(is_null($test)){
            return response()->json(['message' => 'Oups'], 404);
        }
        return response()->json($test,200);
    }
}
