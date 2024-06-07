<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class DetailsLoad
 *
 * @property $id
 * @property $amount
 * @propertyc $reated_at
 * @property $updated_at
 * @property $products_id
 * @property $loads_id
 *
 * @property Load $load
 * @property Product $product
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DetailsLoad extends Model
{
    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['amount', 'products_id', 'loads_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loadRelation()
    {
        return $this->belongsTo(Load::class, 'loads_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
}