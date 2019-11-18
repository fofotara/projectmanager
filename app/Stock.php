<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Stock
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $unit
 * @property float $tax
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stock whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Stock extends Model
{

    protected $guarded = [''];
}
