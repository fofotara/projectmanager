<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded =[''];

    public function categories(){

        return $this->hasMany(Projectdetail::class)->orderBy('sort');
    }
}
