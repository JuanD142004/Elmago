<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @property $id
 * @property $product_name
 * @property $brand
 * @property $price_unit
 * @property $unit_of_measurement
 * @property $suppliers_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Supplier $supplier
 * @property DetailsPurchase[] $detailsPurchases
 * @property DetailsSale[] $detailsSales
 * @property Load[] $loads
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Product extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['product_name', 'brand', 'price_unit', 'unit_of_measurement', 'suppliers_id','enabled'];
    protected $attributes = [
        'enabled' => true,
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo(\App\Models\Supplier::class, 'suppliers_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailsPurchases()
    {
        return $this->hasMany(\App\Models\DetailsPurchase::class, 'id', 'products_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailsSales()
    {
        return $this->hasMany('App\Models\DetailsSale','id', 'products_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function loads()
    {
        return $this->hasMany(\App\Models\Load::class, 'id', 'products_id');
    }
    

}
