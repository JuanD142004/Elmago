<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Load
 *
 * @property int $id
 * @property string $date
 * @property int $routes_id
 * @property int $truck_types_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property bool $enabled
 * @property Carbon|null $disabled_at
 *
 * @property Route $route
 * @property TruckType $truckType
 * @property DetailsLoad[] $detailsLoads
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Load extends Model
{
    protected $fillable = [
        'date', 'routes_id', 'truck_types_id', 'enabled', 'disabled_at'
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'disabled_at' => 'datetime',
    ];

    protected $dates = [
        'date',
        'disabled_at',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'routes_id', 'id');
    }
    
    public function truckType()
    {
        return $this->belongsTo(TruckType::class, 'truck_types_id', 'id');
    }

    public function detailsLoads()
    {
        return $this->hasMany(DetailsLoad::class, 'loads_id', 'id');
    }
}