<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CurrencyCode
 *
 * @property int $id
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CurrencyCode whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CurrencyCode extends Model
{
    protected $guarded = [];
}
