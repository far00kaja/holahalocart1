<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Produk;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $produk=Produk::all();
        $kategoris=Kategori::all();
        return view('dashboard')->with(compact('kategoris','produk'));

    }
    public function filter(Request $request){
        $kategori[]=$request->kategori;
       // echo dd($kategori);
        $filter=DB::table('kategori_produk')->select('produk_id')->whereIn('kategori_id',$kategori)->get();
        //echo $filter;
//        $ks[11]=$kp;
$kategoris=Kategori::all();

        $produk=Produk::all();//::whereIn('id',$kp->produk_id)->get();
        return view('dashboard')->with(compact('kategoris','produk','filter'));


    //    $produk= Produk::Where(function ($query) use($request->kategori) {
    //         for ($i = 0; $i < count($request->kategori ); $i++){
    //               $query->orwhere('location', 'like',  '%' . $kategori[$i] .'%');
    //         }
    //     })->get();
    // }
    }
}
