<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Project
 *
 * @property int $id
 * @property string $title
 * @property string|null $address
 * @property string $image
 * @property string|null $startDate
 * @property string|null $endDate
 * @property string|null $description
 * @property float $budget
 * @property float $area
 * @property int $floor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Projectdetail[] $categories
 * @property-read int|null $categories_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereBudget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Project extends Model
{
    protected $guarded =[''];

    protected $dates =['startDate','endDate'];

    public function categories(){

        return $this->hasMany(Projectdetail::class)->orderBy('sortorder');
    }
}
