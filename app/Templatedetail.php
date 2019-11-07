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
 * @property int $id
 * @property int $template_id
 * @property int $sort
 * @property int|null $templatedetail_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Templatedetail[] $children
 * @property-read int|null $children_count
 * @property-read \App\Templatedetail|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Templatedetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Templatedetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Templatedetail whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Templatedetail whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Templatedetail whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Templatedetail whereTemplatedetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Templatedetail whereUpdatedAt($value)
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
