<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Tax
 *
 * @property int $id
 * @property string $name
 * @property float $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tax newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tax newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tax query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tax whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tax whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tax whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tax whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tax whereValue($value)
 * @mixin \Eloquent
 */
class Tax extends Model
{
    //
}
