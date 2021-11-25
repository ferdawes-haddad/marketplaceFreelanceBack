<?php

namespace App\Http\Controllers;

use App\skills_emplois;
use App\user;
use App\user_skills;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;
use File;
use Response;

class UserController extends Controller
{

    public function login(Request $request){
        $credentials = $request->only('email','password','role');
        try {
            if (!JWTAuth::attempt($credentials)){
                $response['status'] = 0;
                $response['code'] = 400;
                $response['data'] = null;
                $response['message'] = 'E-mail ou mot de passe incorrect';
                return response()->json($response);
            }
        }catch (JWTException $e){
            $response['data'] = null;
            $response['code'] = 500;
            $response['message'] = 'Impossible de créer le Token';
            return response()->json($response);
        }

        $user = auth()->user();
        $data['token'] = auth()->claims([
            'user_id'            => $user->id,
            'email'              => $user->email,
            'role'               => $user->role,
        ])->attempt($credentials);

        $response['data'] = $data;
        $response['status'] = 1;
        $response['code'] = 200;
        $response['message'] = 'Connectez-vous avec succès';
        return response()->json($response);
    }

    public function updateUser(Request $request, $id) {
        $user = user::find($id);
        if(is_null($user)) {
            return response()->json(['message' => 'Pas trouvé'], 404);
        }
        $user->update($request->all());
        return response($user, 200);
    }

    public function deleteUser(Request $request, $id) {
        $user = user::find($id);
        if(is_null($user)) {
            return response()->json(['message' => 'Pas trouvé'], 404);
        }
        $user->delete();
        return response()->json(null, 204);
    }

    public function getUsers()
    {
        $users = user::all();
        return $users;
    }

    public function getUserById($id)
    {
        $user = user::find($id);
        if (is_null($user)) {
            return response()->json(['message' => 'Ouups!'], 404);
        }
        return response()->json($user::find($id), 200);
    }

    public function getFreelancer($role)
    {
        $freelancer = user::where('role', 'freelance')->get();
        if (is_null($freelancer)) {
            return response()->json(['message' => 'Ouups!'], 404);
        }
        return response()->json($freelancer, 200);
    }

    public function getESN($role)
    {
        $freelancer = user::where('role', 'esn')->get();
        if (is_null($freelancer)) {
            return response()->json(['message' => 'Ouups!'], 404);
        }
        return response()->json($freelancer, 200);
    }

    public function uploadimage(Request $request , $id)
    {
        //dd($request->all());
        //$user_image = user::where('id',"=",$id)->first();
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

        $description =user::where('id',"=",$id)->pluck('image')->first();
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

    /*public function registerwithImage(Request $request)
    {
       $user = new user();
            $user->nom = $request->nom;
            $user->prenom = $request->prenom;
            $user->telephone = $request->telephone;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->confirmPassword = $request->confirmPassword;
            $user->role = $request->role;
            $user->adresse = $request->adresse;
            //$user->image = $request->image;

            if ($request->hasFile('image'))
            {
                //dd($request->all());
                //$user_image = user::where('id',"=",$id)->first();
                $file     = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move(public_path('img'), $filename);
                $user->image = $filename;
            }
            $user->save();

            return response()->json(["message" => "Image Uploaded Succesfully", $user, 201]);


    }*/

    public function register(Request $request){

        $user = user::where('email', $request['email'])->first();
        if ($user){
            $response['status'] = 0;
            $response['message'] =  'L"email existe déjà ';
            $response['code'] = 400;
        } else{

            $user = user::create([
                'nom'               => $request->nom,
                'prenom'            => $request->prenom,
                'telephone'         => $request->telephone,
                'email'             => $request->email,
                'password'          => bcrypt($request->password),
                'confirmPassword'   => bcrypt($request->password_repeat),
                'role'              => $request->role,
                'adresse'           => $request->adresse,
                'description'       => $request->description,
                'image'             => $request->image

            ]);
            $response['status'] = 1;
            $response['message'] =  'utilisateur enregistré avec succès';
            $response['code'] = 200;
        }

        return response()->json($response);
    }

    public function markNotification (Request  $request)
    {
        $user = auth()->user();
        if ($user) {

            $pushToken = PushToken::where('user_id', $user->id)->first();

            if ($pushToken) {
                //update the existing token
                $pushToken->token = $request->push_token;
                $pushToken->save();
            } else {
                //create new token for user
                $pushToken = new PushToken();
                $pushToken->token = $request->push_token;
                $pushToken->user_id = $user->id;
                $pushToken->save();
            }
            $success = $request->push_token;
            return response()->json($success);
        }
        return response()->json(['success' => false], 401);
    }

}
