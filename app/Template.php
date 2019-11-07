<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Template
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Template newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Template newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Template query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Template whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Template whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Template whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Template whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Template whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Templatedetail[] $categories
 * @property-read int|null $categories_count
 */
class Template extends Model
{
    protected $guarded = [''];

    public function categories(){

        return $this->hasMany(Templatedetail::class)->orderBy('sort');
    }
}
