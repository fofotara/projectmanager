<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Templatedetail
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Templatedetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Templatedetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Templatedetail query()
 * @mixin \Eloquent
 */
class Templatedetail extends Model
{
    protected $guarded = [''];

    public function parent(){
        return $this->belongsTo('App\Templatedetail','templatedetail_id');
    }

    public function children(){
        return $this->hasMany('App\Templatedetail','templatedetail_id')->orderBy('sort');
    }
}
