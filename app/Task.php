<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Task
 *
 * @property int $id
 * @property string $text
 * @property int $duration
 * @property float $progress
 * @property string $start_date
 * @property int $parent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $sortorder
 * @property-read mixed $open
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereProgress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereSortorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Task extends Model
{
    protected $appends = ["open"];

    public function getOpenAttribute(){
        return true;
    }
}
