<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Route
 *
 * @property $id
 * @property $route_name
 * @property $departament_id
 * @property $municipalities	
 * @property $created_at
 * @property $updated_at
 *
 * @property Departament $departament
 * @property Customer[] $customers
 * @property Employee[] $employees
 * @property Load[] $loads
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Route extends Model
{
    static $rules = [
        'municipalities' => 'required',	
        'route_name	'=> 'required',	
        'departament_id'=> 'required',	
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['route_name', 'departament_id', 'municipalities','enabled'];
    protected $attributes = [
        'enabled' => true,
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departament()
    {
        return $this->belongsTo(\App\Models\Departament::class, 'departament_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customers()
    {
        return $this->hasMany(\App\Models\Customer::class, 'id', 'routes_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function employees()
    // {
    //     return $this->hasMany(\App\Models\Employee::class, 'id', 'routes_id');
    // }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function loads()
    {
        return $this->hasMany(\App\Models\Load::class, 'id', 'routes_id');
    }
    

}
