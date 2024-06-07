<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Route;
use App\Models\Sale;

/**
 * Class Customer
 *
 * @property $id
 * @property $customer_name
 * @property $company_name
 * @property $location
 * @property $cell_phone
 * @property $mail
 * @property $routes_id
 * @property $enabled
 * @property $created_at
 * @property $updated_at
 *
 * @property Route $route
 * @property Sale[] $sales
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Customer extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['customer_name', 'company_name', 'location', 'cell_phone', 'mail', 'routes_id', 'enabled'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function route()
    {
        return $this->belongsTo(\App\Models\Route::class, 'routes_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales()
    {
        return $this->hasMany(\App\Models\Sale::class, 'id', 'customers_id');
    }
    

}