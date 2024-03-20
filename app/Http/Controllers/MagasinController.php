<?php

namespace App\Http\Controllers;

use App\Models\client;
use App\Models\stocks;
use App\Models\Article;
use App\Models\Magasin;
use App\Models\commercials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MagasinController extends Controller
{
    public function GetMagasin(){ 
        $magasins = Magasin::all();
        foreach ($magasins as $magasin) {
            $IdVille = $magasin->IdVille; 
            $IdDepot = $magasin->IdDepot; 
            $Villes = DB::select('select Ville from ville where IdVille = ?', [$IdVille]);
            $VilleName = [];
        foreach ($Villes as $Ville) {
            $VilleName[] = $Ville->Ville;
        }

        $magasin->VilleName = $VilleName;
        $Depots = DB::select('select NomDepot from depot where IdDepot = ?', [$IdDepot]);
        $DepotName = [];
        foreach ($Depots as $Depot) {
            $DepotName[] = $Depot->NomDepot;
        }

        $magasin->DepotName = $DepotName;
    }
        return response()->json($magasins, 200);
    }
    public function GetMagasinById($id){ 
        $magasins = DB::select('select * from magasin where IdMagasin  = ?',[$id]);
        foreach($magasins as $magasin)
        $IdVille=$magasin->IdVille; 
        $ville = DB::select('select Ville from ville where IdVille = ?',[$IdVille]);
        return response()->json([$magasin,$ville],200);
    }
    public function AddMagasin(request $request){ 
        $request->validate([
            'NomMagasin' => 'required',
            'Tele' => 'required|numeric',
            'Adresse' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'Fax' => 'required|numeric',
        ]);
        $NameMagasin = $request->NomMagasin;
        $ImageMagasin =$request->file('image')->store('MagasinIMG','public');
        $AdressMagasin = $request->Adresse;
        $FaxMagasin = $request->Fax;
        $TeleMagasin = $request->Tele;
            Magasin::create([
                'NomMagasin'=>$NameMagasin,
                'ImageEP'=>$ImageMagasin,
                'Adresse'=>$AdressMagasin,
                'Tele'=>$TeleMagasin,
                'Fax'=>$FaxMagasin,
                'IdDepot'=>1,
                'IdVille'=>4,
                'Supprime'=>false,



            ]);
        return response()->json(['message'=>'Magasin added successfuly'], 200);
    }
    public function EditMagasin($id){ 
        dd($id);
    }
    public function DeleteMagasin($id){ 
        dd($id);
    }
    // public function getMagasinsMerch($id) { 
    //     $MagasinStock = DB::connection('mysql_second')->table('stocks')->select('*')->get();
    //     $Substitu = DB::select('select * from article_x_substitut ');
    //     $articleIds = [];
    //     $articleQuantities = [];
        
    //     foreach ($MagasinStock as $magasin) {
    //         $articleIds[] = $magasin->IdArticle;
    //         $articleQuantities[$magasin->IdArticle] = $magasin->quantité;
    //     }
        
    //     $articles = DB::table('articles')
    //         ->whereIn('articles.IdArticle', $articleIds)
    //         ->leftJoin('article_x_substitut', 'articles.IdArticle', '=', 'article_x_substitut.IdArticle')
    //         ->select('articles.*', 'article_x_substitut.libellesubstitut')
    //         ->get();
        
    //     foreach ($articles as $article) {
    //         if (isset($articleQuantities[$article->IdArticle])) {
    //             $article->quantité = $articleQuantities[$article->IdArticle];
    //         }
    //     }
        
    //     return response()->json($articles, 200);
        
    // }
    public function getMagasinsMerch($id) { 
        $MagasinStock = DB::connection('mysql_second')->table('stocks')->select('*')->get();
        $substitut = DB::select('select * from article_x_substitut ');
        
        $ArticleSub = [];
        $articleIds = [];
        $articleQuantities = [];
        
        foreach ($MagasinStock as $magasin) {
            $articleIds[] = $magasin->IdArticle; 
            $articleQuantities[$magasin->IdArticle] = $magasin->quantité; 
        }
        
        $articles = DB::table('articles')->whereIn('IdArticle', $articleIds)->get();
        
        foreach ($articles as $article) {
            $libelleSubstitutArray = DB::table('article_x_substitut')
                ->where('IdArticle', $article->IdArticle)
                ->pluck('LibelleSubstitut')
                ->toArray();
        
            // Join the LibelleSubstitut array into a single string
            $article->LibelleSubstitut = implode(', ', $libelleSubstitutArray);
        
            if (isset($articleQuantities[$article->IdArticle])) {
                $article->quantité = $articleQuantities[$article->IdArticle];
            }
        }
        
        return response()->json($articles, 200);
    }        
// public function AddArticleMagasin(Request $request){
//         $NomArticle = $request->Designation
// }
    public function GetArticleMagasinById($MagasinId,$id ){
        $MagasinStock = DB::connection('mysql_second')->table('stocks')->select('*')->get();
        $articleQuantities = []; 
        $id = is_array($id) ? $id : [$id];

        foreach ($MagasinStock as $magasin) {
            $articleQuantities[$magasin->IdArticle] = $magasin->quantité; 
        }
            $articles = DB::table('articles')->whereIn('IdArticle', $id)->get();
    
        foreach ($articles as $article) {
            if (isset($articleQuantities[$article->IdArticle])) {
                $article->quantité = $articleQuantities[$article->IdArticle];
            }
        }
        return response()->json($articles, 200);
    }
    
    public function GetCommercials(){
        $Commercials = DB::connection('mysql_second')->table('commercials')->select('*')->get();
        return response()->json($Commercials,200);

}
public function AddCommercial(request $request){
    $request->validate([
        'nom'=>'required',
        'prenom'=>'required',
    ]);
        $NomCommercial = $request->nom;
        $PrenomCommercial = $request->prenom;
        $telephone = $request->télephone;
        $ville = $request->ville;
        commercials::create([
            "nom"=>$NomCommercial,
            "prenom"=>$PrenomCommercial,
            "télephone"=>$telephone,
            "ville"=>$ville,
            "email"=>$NomCommercial.".".$PrenomCommercial."@gmail.com",
            "password"=>$PrenomCommercial."1",

        ]);
        return response()->json('commercial bien ajouter', 200);


}
public function AddClient(request $request){
    $request->validate([
        'NomClient'=>'required',
        'PrenomClient'=>'required',
        'Ville'=>'required',
        'ICE'=>'required|min:6|max:6',


    ]);
        $NomClient = $request->NomClient;
        $PrenomClient = $request->PrenomClient;
        $CreditClient = $request->Credit;
        $ville = $request->Ville;
        $NumTele = $request->NumTele;
        $ICE = $request->ICE;

        client::create([
            "NomClient"=>$NomClient,
            "PrenomClient"=>$PrenomClient,
            "Credit"=>$CreditClient,
            "Ville"=>$ville,
            "EmailClient"=>$NomClient.".".$PrenomClient."@gmail.com",
            "PasswordClient"=>$PrenomClient."2",
            "NumTele"=>$NumTele,
            "AddresseFacturation"=>"0",
            "SoldeMaximum"=>"0",
            "Patente"=>"0",
            "I_F"=>"0",
            "ICE"=>$ICE,


        ]);
        return response()->json("good", 200);


}
public function GetClient(){
    $Clients = DB::connection('mysql_second')->table('clients')->select('*')->get();
    return response()->json($Clients,200);

}
public function AddArticleMagasin(request $request){
    $NomArticle=$request->Designation;
    $Prix1Article=$request->PrixVenteArticleTTC;
    $Prix2Article=$request->prix_ht_2_magasin;
    $Prix3Article=$request->prix_ht_3_magasin;
    $PrixTtcArticle=$request->prix_ttc_magasin;
    $RefArticle=$request->RefArticle;
    $Quantité=$request->quantité;
    $Description=$request->Description;
    $Unite=$request->Unite;
    $Image = $request->file('image')->store('ArticleIMG', 'public');

    $request->validate([
        'Designation' => 'required',
        'image' =>'required|image|mimes:jpeg,png,jpg',
        'PrixVenteArticleTTC' => 'required|numeric',
        'Unite' => 'required|numeric',
        'RefArticle' => 'required',
        "prix_ht_2_magasin"=> 'required',
        "prix_ht_3_magasin"=> 'required',
        "prix_ttc_magasin"=> 'required',

    ]);
    $article = Article::create([
        "Designation"=>$NomArticle,
        "PrixVenteArticleTTC"=>$Prix1Article,
        "RefArticle"=>$RefArticle,
        "Description"=>$Description,
        "Unite"=>$Unite,
        "Image"=>$Image,
        "stock"=>100,

    ]);

    stocks::create([
        "IdArticle"=>$article->IdArticle,
        "prix_ht_1_magasin"=>$Prix1Article,
        "prix_ht_2_magasin"=>$Prix2Article,
        "prix_ht_3_magasin"=>$Prix3Article,
        "prix_ttc_magasin"=>$PrixTtcArticle,
        "quantité"=>$Quantité,
    ]);

    return response()->json(['message'=>'article added successfuly'], 200);
    

}
}

