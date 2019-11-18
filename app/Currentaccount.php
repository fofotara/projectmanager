<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Currentaccount
 *
 * @property int $id
 * @property int $user_id
 * @property int $currentaccount_id
 * @property string $code
 * @property string $company
 * @property string $user
 * @property string $tax
 * @property string $taxname
 * @property string $telephone
 * @property string $email
 * @property string $address
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currentaccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currentaccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currentaccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currentaccount whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currentaccount whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currentaccount whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currentaccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currentaccount whereCurrentaccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currentaccount whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currentaccount whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currentaccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currentaccount whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currentaccount whereTaxname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currentaccount whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currentaccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currentaccount whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currentaccount whereUserId($value)
 * @mixin \Eloquent
 */
class Currentaccount extends Model
{
    protected $guarded = [];

    public static function boot(){
        parent::boot();
        static::creating(function($model){
            $model->user_id = \Auth::user()->id;
        });
    }
}
