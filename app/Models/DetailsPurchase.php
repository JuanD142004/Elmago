<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetailsPurchase
 *
 * @property $id
 * @property $products_id
 * @property $purchase_lot
 * @property $amount
 * @property $unit_value
 * @property $purchases_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Product $product
 * @property Purchase $purchase
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DetailsPurchase extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['products_id', 'purchase_lot', 'amount', 'unit_value', 'purchases_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'products_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchase()
    {
        return $this->belongsTo(\App\Models\Purchase::class, 'purchases_id', 'id');
    }
    

}
