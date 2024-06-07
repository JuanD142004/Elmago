<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Departament
 *
 * @property $id
 * @property $name
 * @property $created_at
 * @property $updated_at
 * @property $enabled
 *
 * @property Municipality[] $municipalities
 * @property Route[] $routes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Departament extends Model
{
    use HasFactory;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'enabled'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function routes()
    // {
    //     return $this->hasMany(\App\Models\Route::class, 'id', 'departament_id');
    // }
    
    public function municipalities()
    {
        return $this->hasMany(\App\Models\Municipality::class, 'departaments_id', 'id');
    }

}
