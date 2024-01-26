<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class AdminController extends Controller
{
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
public function GetArticle(){
    $Articles = Article::all();
    return response()->json($Articles, 200,);
}
}

