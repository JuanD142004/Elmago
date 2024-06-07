<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Purchase
 *
 * @property $id
 * @property $suppliers_id
 * @property $date
 * @property $total_value
 * @property $num_bill
 * @property $created_at
 * @property $updated_at
 *
 * @property Supplier $supplier
 * @property DetailsPurchase[] $detailsPurchases
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Purchase extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['suppliers_id', 'date', 'total_value', 'num_bill'];


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
        return $this->hasMany(\App\Models\DetailsPurchase::class, 'purchases_id', 'id');
    }
    

}
