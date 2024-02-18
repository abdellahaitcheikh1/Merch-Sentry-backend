<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Dataarticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // function add product 

    public function AddArticle(request $request){
        $request->validate([
            'Designation' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'PrixVenteArticleTTC' => 'required|numeric',
            'Description' => 'required',
            'Unite' => 'required|numeric',
            'stock' => 'required|numeric',
            'RefArticle' => 'required|numeric',


        ]);
        $NameArticle = $request->Designation;
        $ImageArticle =$request->file('image')->store('ArticleIMG','public');
        $PriceArticle = $request->PrixVenteArticleTTC;
        $DescriptionArticle = $request->Description;
        $UniteArticle = $request->Unite;
        $StockArticle = $request->stock;
        $RefArticle = $request->RefArticle;


            Article::create([
                'Designation'=>$NameArticle,
                'Image'=>$ImageArticle,
                'PrixVenteArticleTTC'=>$PriceArticle,
                'Unite'=>$UniteArticle,
                'Description'=>$DescriptionArticle,
                'RefArticle'=>$RefArticle,
                'stock'=>$StockArticle,



            ]);
        return response()->json(['message'=>'article added successfuly'], 200);
}

// function show all product 

public function GetArticle(){ 
    $articles = DB::table('dataarticle')->take(5)->get();
    return response()->json($articles, 200,);
}
// public function GetArticle(){ 
//     $articles = DB::table('dataarticle')->take(5)->get();
//     return response()->json($articles, 200,);
// }

// function show product by id 

public function GetArticleById($id){
    $Article = DB::select("select * from articles where IdArticle = ?", [$id]);
    foreach($Article as $article)

    return response()->json($article, 200);
}

// function update product 

public function UpdateArticle($id){
    $Article = DB::select("select * from articles where IdArticle = ?", [$id]);
    foreach($Article as $article)
    return response()->json($article, 200);
}

public function EditArticle(Request $request , Article $Article){
    // $article->Designation = $request->Designation;
    // $article->PrixVenteArticleTTC = $request->PrixVenteArticleTTC;
    // $article->Description = $request->Description;
    // $article->Unite = $request->Unite;
    // $article->stock = $request->stock;
    // $article->RefArticle= $request->RefArticle;
    // if ($request->has('image')) {
    //     $image = $request->file('image')->store('ArticleIMG', 'public');
    //     $article->image = $image;
    // }
    // $article->save();
    dd($request);

    // return response()->json(['message'=>'article added successfuly'], 200);
}

// function delete product 


}

