<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projectdetail extends Model
{
    protected $guarded = [''];

    public function parent(){
        return $this->belongsTo('App\Projectdetail','projectdetail_id');
    }

    public function children(){
        return $this->hasMany('App\Projectdetail','projectdetail_id')->orderBy('sort');
    }
}
