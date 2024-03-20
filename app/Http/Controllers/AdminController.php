<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Dataarticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // function add Article 

    public function AddArticle(request $request){

        // TODO renomer les variables 
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
            // TODO if create ok add in historiques des operations 
        return response()->json(['message'=>'article added successfuly'], 200);
}

// function show all Article 

public function GetArticle(){ 
    $articles = DB::table('articles')->take(5)->get();
    return response()->json($articles, 200,);
}

// function show Article by id 

public function GetArticleById($id){
    $Article = DB::select("select * from articles where IdArticle = ?", [$id]);
    $libelle = DB::select("select LibelleSubstitut from article_x_substitut where IdArticle = ?", [$id]);

    foreach($Article as $article)

    return response()->json([$article,$libelle ],200);
}


// function update Article 

public function UpdateArticle($id){
    $Article = DB::select("select * from articles where IdArticle = ?", [$id]);
    foreach($Article as $article)
    return response()->json($article, 200);
}


// function Edite Article 

public function EditArticle(Request $request , $id){
    $article = Article::find($id);
    $validated_Artcile = $request->validate([
        'Designation' => 'required',
        'PrixVenteArticleTTC' => 'required',
        'Description' => 'required',
        'Unite' => 'required',
        'stock' => 'required',
        'RefArticle' => 'required',
    ]);

    $article->fill($validated_Artcile);

    if ($request->hasFile('image')) {
        $article->image = $request->file('image')->store('ArticleIMG', 'public');
    }
    $article->save();
            // TODO if create ok add in historiques des operations 

    return response()->json([
        'message' => 'Article Updated successfully!',
    ]);
}

// function delete Article 
public function DeleteArticle($id){
    
    $Articles_deleting = DB::delete("DELETE from articles where IdArticle = ?", [$id]);
    if($Articles_deleting){
        
        return response()->json([
            'message'=>'The product has been successfully deleted'
        ], 200);
            // TODO if create ok add in historiques des operations 

    }else{
        return response()->json([
            'message'=>'no product with this id '
        ], 200);
    }
}

}

