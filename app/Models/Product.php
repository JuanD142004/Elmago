<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @property int $id
 * @property string $product_name_and_brand
 * @property string $price_unit
 * @property string $product_description
 * @property int $stock
 * @property int $suppliers_id
 * @property bool $enabled
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property Supplier $supplier
 */
class Product extends Model
{
    protected $fillable = ['product_name_and_brand', 'price_unit', 'product_description', 'stock', 'suppliers_id', 'enabled'];

    public function supplier()
    {
        return $this->belongsTo(\App\Models\Supplier::class, 'suppliers_id', 'id');
        return $this->belongsTo(Supplier::class);
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
    public function scopeEnabledSupplier($query)
    {
        return $query->whereHas('supplier', function ($query) {
            $query->where('enabled', true);
        });
    }
    

}
