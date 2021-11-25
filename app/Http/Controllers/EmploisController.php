<?php

namespace App\Http\Controllers;

use App\categories;
use App\emplois_skyles;
use App\skyles;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Emplois;
use Illuminate\Support\Facades\DB;
use File;
use Response;

class EmploisController extends Controller
{

    public function getEmploisById($id)
    {
        $emplois = Emplois::find($id);
        if (is_null($emplois)) {
            return response()->json(['message' => 'Ouups!'], 404);
        }
        return response()->json($emplois::find($id), 200);
    }

    public function ajoutEmplois(Request $request)
    {

        $emplois = new Emplois();

        $emplois->titre = $request->titre;
        $emplois->description = $request->description;
        $emplois->adresse=$request->adresse;
        $emplois->salaire = $request->salaire;
        $emplois->rating = $request->rating;
        $emplois->date_creation = $request->date_creation;
        $emplois->status = $request->status;
        $emplois->categories_id = $request->categories_id;
        $emplois->image = $request->image;

        if ($request->hasFile('image'))
        {
            //dd($request->all());
            //$user_image = Emplois::where('id',"=",$id)->first();
            $file     = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move(public_path('img'), $filename);
            $emplois->image = $filename;
        }
        $emplois->save();
        return response()->json(["message" => "Image Uploaded Succesfully", $emplois, 201]);

    }

    public function updateEmplois(Request $request, $id) {
        $emplois = Emplois::find($id);
        if(is_null($emplois)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $emplois->update($request->all());
        return response($emplois, 200);
    }

    public function deleteEmplois(Request $request, $id) {
        $emplois = Emplois::find($id);
        if(is_null($emplois)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $emplois->delete();
        return response()->json(null, 204);
    }

    public function getUserByEmplois($id){

        $user = DB::table('emplois')->select('users_id')
            ->where('users_id', 'id', '=', 'id')
            ->get();
        return $user;
    }

    public function getAllEmploisBySkyles($id){
        $emplois = emplois::find($id);
        $skyles = $emplois->skyles;
        return $skyles;
    }

    public function getallEmplois(){
        $test = Emplois::with('categoriesName')->get();
        if(is_null($test)){
            return response()->json(['message' => 'Oups'], 404);
        }
        return response()->json($test,200);
    }

    public function uploadimage(Request $request , $id)
    {
        //dd($request->all());
        //$user_image = Emplois::where('id',"=",$id)->first();
        if ($request->hasFile('image'))
        {
            $image      = $request->file('image');
            $filename  = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $picture   = date('His').'-'.$filename;
            $image->move(public_path('img'), $picture);
            //$image =  erpw_user::whereId('1')->first()->save();

            //$user_image->image 	= $picture;
            // $user_image->save();
            return response()->json(["message" => "Image Uploaded Succesfully"]);
        }
        else
        {
            return response()->json(["message" => "Select image first."]);
        }
    }

    public function displayImage($id)
    {

        $description =Emplois::where('id',"=",$id)->pluck('image')->first();
        //return $description;
        $path = public_path('img/' . $description);
        if (!File::exists($path)) {
            abort(404);
        }
        $image = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($image, 200);
        $response->header("Content-Type", $type);
        return $response;

    }

    public function getUser()
    {
        $user = \App\user::with('usersName')->get();
        if(is_null($user)){
            return response()->json(['message' => 'Oups'], 404);
        }
        return response()->json($user,200);
    }

}
