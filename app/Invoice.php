<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Invoice
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property int $currentAccount_id
 * @property string|null $currencyCode
 * @property float $currency
 * @property float $amount
 * @property float $discount
 * @property float $lastAmount
 * @property float $tax
 * @property float $total
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereCurrentAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereLastAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereUserId($value)
 */
class Invoice extends Model
{
    protected $guarded = [''];
}
