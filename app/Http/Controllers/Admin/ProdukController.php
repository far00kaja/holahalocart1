<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kategori;
use App\Produk;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use File;

class ProdukController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$users=User::all();
        $produk= Produk::all();
        return view('admin.produk.index')->with(compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori=Kategori::all();
        return view('admin.produk.add')->with(compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        //$imageName = time().'.'.$request->image->extension();
        $name = Str::slug(($request->name.' '.(Str::random(10))),'_').'.'.$request->foto->extension();
        $request->foto->move(public_path('images'), $name);
        $produk=new Produk;
        $produk->nama=$request->name;
        $produk->foto=$name;
        $produk->deskripsi=$request->deskripsi;
        $produk->handled_id=\Auth::user()->id;
        $produk->save();

        $prod=Produk::orderBy('id','desc')->first();
        echo $prod;
        $prod->tags()->sync($request->kategori);

        // return 'kesini';
      return redirect()->route('admin.produk.index');



        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk=Produk::find($id);
        $kategoris=Kategori::all();
        return view('admin.produk.edit')->with(compact('produk','kategoris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $p=Produk::find($id);
        $p->tags()->sync($request->kategori);

        if ($request->hasFile('foto')) {
            $image = Produk::where('id',$id)->first();
              $local = "images/".$image->foto;
                File::delete($local);
            $name = Str::slug(($request->name.' '.(Str::random(10))),'_').'.'.$request->foto->extension();
            $request->foto->move(public_path('images'), $name);
            $p->foto=$name;
        }
        $p->nama=$request->name;
        $p->deskripsi=$request->deskripsi;
        $p->save();

       return redirect()->route('admin.produk.index');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        //
          //
          if(Gate::denies('delete-users')){
            return redirect(route('admin.produk.index'));
        }
        $produk=Produk::find($id)->delete();

        return redirect()->route('admin.produk.index');

    }
}
