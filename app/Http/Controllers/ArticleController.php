<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use File;
use Response;

class ArticleController extends Controller
{
    public function getArticle()
    {
        $data = Article::all();
        return $data;
    }

    public function getArticleById($id)
    {
        $blog = Article::find($id);
        if (is_null($blog)) {
            return response()->json(['message' => 'Ouups!'], 404);
        }
        return response()->json($blog::find($id), 200);
    }

    public function addArticle(Request $request)
    {
        //$blog = Article::create($request->all());
       // return response($blog, 201);

        $article = new Article();

        $article->titre = $request->titre;
        $article->description = $request->description;
        $article->nom=$request->nom;
        $article->email = $request->email;
        $article->date = $request->date;
        $article->commentaire_id = $request->commentaire_id;
        //$emplois->image = $request->image;

        if ($request->hasFile('image'))
        {
            //dd($request->all());
            //$user_image = Emplois::where('id',"=",$id)->first();
            $file     = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move(public_path('img'), $filename);
            $article->image = $filename;
        }
        $article->save();
        return response()->json(["message" => "Image Uploaded Succesfully", $article, 201]);

    }

    public function uploadimage(Request $request , $id)
    {
        //dd($request->all());
        //$user_image = Article::where('id',"=",$id)->first();
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

        $description =Article::where('id',"=",$id)->pluck('image')->first();
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

    public function updateArticle(Request $request, $id) {
        $blog = Article::find($id);
        if(is_null($blog)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $blog->update($request->all());
        return response($blog, 200);
    }

    public function deleteArticle(Request $request, $id) {
        $blog = Article::find($id);
        if(is_null($blog)) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $blog->delete();
        return response()->json(null, 204);
    }

}
