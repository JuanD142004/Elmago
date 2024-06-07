<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TruckType
 *
 * @property $id
 * @property $truck_brand
 * @property $plate
 * @property $ability
 * @property $created_at
 * @property $updated_at
 * @property $enabled
 *
 * @property Load[] $loads
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TruckType extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['truck_brand', 'plate', 'ability', 'enabled'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function loads()
    {
        return $this->hasMany(\App\Models\Load::class, 'id', 'truck_types_id');
    }
    

}
