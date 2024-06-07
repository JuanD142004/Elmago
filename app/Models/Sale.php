<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sale
 *
 * @property $id
 * @property $customers_id
 * @property $price_total
 * @property $payment_method
 * @property $created_at
 * @property $updated_at
 *
 * @property Customer $customer
 * @property DetailsSale[] $detailsSales
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Sale extends Model
{

    static $rules = [
        'customers_id' => 'required',
        'price_total' => 'required',
        'payment_method' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['customers_id', 'price_total', 'payment_method'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    // Sale.php (Modelo)
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customers_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailsSales()
    {
        return $this->hasMany('App\Models\DetailsSale', 'sales_id', 'id');
    }

    public function customers()
    {
        return $this->hasMany('App\Models\customers', 'id', 'customers_id');
    }
}
