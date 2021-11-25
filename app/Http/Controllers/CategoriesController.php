<?php

namespace App\Http\Controllers;

use App\categories;
use App\Emplois;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function getCategorie()
    {
        $data = categories::all();
        return $data;
    }

    public function getCategorieById($id)
    {
        $categorie = categories::find($id);
        if (is_null($categorie)) {
            return response()->json(['message' => 'Ouups!'], 404);
        }
        return response()->json($categorie::find($id), 200);
    }

    public function addCategorie(Request $request)
    {
        $categorie = categories::create($request->all());
        return response($categorie, 201);
    }

    public function updateCategorie(Request $request, $id) {
        $categorie = categories::find($id);
        if(is_null($categorie)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $categorie->update($request->all());
        return response($categorie, 200);
    }

    public function deleteCategorie(Request $request, $id) {
        $categorie = categories::find($id);
        if(is_null($categorie)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $categorie->delete();
        return response()->json(null, 204);
    }


}
