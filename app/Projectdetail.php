<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Projectdetail
 *
 * @property int $id
 * @property int $project_id
 * @property int $duration
 * @property float $progress
 * @property int $sortorder
 * @property int|null $parent
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Projectdetail[] $children
 * @property-read int|null $children_count
 * @property-read \App\Projectdetail|null $parents
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Projectdetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Projectdetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Projectdetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Projectdetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Projectdetail whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Projectdetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Projectdetail whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Projectdetail whereProgress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Projectdetail whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Projectdetail whereSortorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Projectdetail whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Projectdetail whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Projectdetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Projectdetail extends Model
{
    protected $guarded = [''];
    protected $dates =['start_date'];

    public function parents(){
        return $this->belongsTo('App\Projectdetail','parent');
    }

    public function children(){
        return $this->hasMany('App\Projectdetail','parent')->orderBy('sortorder');
    }
}
