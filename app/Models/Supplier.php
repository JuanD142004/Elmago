<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Supplier
 *
 * @property $id
 * @property $nit
 * @property $supplier_name
 * @property $cell_phone
 * @property $mail
 * @property $address
 * @property $created_at
 * @property $updated_at
 *
 * @property Product[] $products
 * @property Purchase[] $purchases
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Supplier extends Model
{
    
    static $rules = [
		'nit' => 'required|string',
		'supplier_name' => 'required|string',
		'cell_phone' => 'required',
		'mail' => 'string',
		'address' => 'string',
        
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nit','supplier_name','cell_phone','mail','address','enabled'];

    protected $attributes = [
        'enabled' => true,
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(\App\Models\Product::class, 'id', 'suppliers_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchases()
    {
        return $this->hasMany('App\Models\Purchase', 'suppliers_id', 'id');
    }
    

}
