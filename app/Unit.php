<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Unit
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Unit whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Unit extends Model
{

}
