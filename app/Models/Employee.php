<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Employee
 *
 * @property $id
 * @property $users_id
 * @property $gender
 * @property $civil_status
 * @property $routes_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Route $route
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Employee extends Model
{
    
    static $rules = [
		'users_id' => 'required',
        'name' => 'required|string',
        'surname' => 'required|string',
		'gender' => 'required|string',
        'document_number' => 'required|string',
		'civil_status' => 'required|string',
        'eps' => 'required|string',
        'phone' => 'required|string',
        'children' => 'required|string',
        'home' => 'required|string',
		'routes_id' => 'required',
    ];
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['users_id','name','surname','gender','document_number','civil_status','eps','phone','children','home','routes_id','enabled'];

    protected $attributes = [
        'enabled' => true,
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function route()
    {
        return $this->belongsTo(\App\Models\Route::class, 'routes_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'users_id', 'id');
    }
    

}
