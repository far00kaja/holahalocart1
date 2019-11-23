<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    //
    protected $fillable = [
        'nama', 'foto', 'deskripsi','handled_id'
    ];


    public function user(){
        return $this->belongsTo('App\User','handled_id','id');
    }
    public function tags(){
        return $this->belongsToMany('App\Kategori');
   }

}

