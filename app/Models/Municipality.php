<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Municipality
 *
 * @property $id
 * @property $name
 * @property $created_at
 * @property $departaments_id
 * @property $updated_at
 * @property $enabled
 *
 * @property Departament $departament
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Municipality extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'departaments_id', 'enabled'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departament()
    {
        return $this->belongsTo(\App\Models\Departament::class, 'departaments_id', 'id');
    }
    

}
