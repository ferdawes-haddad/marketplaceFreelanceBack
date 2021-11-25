<?php

namespace App\Http\Controllers;

use App\user_skyles;
use Illuminate\Http\Request;

class UserSkylesController extends Controller
{
    public function getUserSkyles()
    {
        $data = user_skyles::all();
        return $data;
    }

    public function getUserSkylesById($id)
    {
        $userSkyles = user_skyles::find($id);
        if (is_null($userSkyles)) {
            return response()->json(['message' => 'Ouups!'], 404);
        }
        return response()->json($userSkyles::find($id), 200);
    }

    public function addUserSkyles(Request $request)
    {
        $userSkyles = user_skyles::create($request->all());
        return response($userSkyles, 201);
    }

    public function updateUserSkyles(Request $request, $id) {
        $userSkyles = user_skyles::find($id);
        if(is_null($userSkyles)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $userSkyles->update($request->all());
        return response($userSkyles, 200);
    }

    public function deleteUserSkyles(Request $request, $id) {
        $userSkyles = user_skyles::find($id);
        if(is_null($userSkyles)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $userSkyles->delete();
        return response()->json(null, 204);
    }
}
