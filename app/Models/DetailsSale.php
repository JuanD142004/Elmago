<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetailsSale
 *
 * @property $id
 * @property $products_id
 * @property $price_unit
 * @property $amount
 * @property $discount
 * @property $sales_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Product $product
 * @property Sale $sale
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DetailsSale extends Model
{
    protected $table = 'details_sales'; // Nombre de la tabla

    static $rules = [
        'products_id' => 'required',
        'price_unit' => 'required',
        'amount' => 'required',
        'discount' => 'required',
        'sales_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['products_id', 'price_unit', 'amount', 'discount', 'sales_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'products_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sale()
    {
        return $this->hasOne('App\Models\Sale', 'id', 'sales_id');
    }
}
