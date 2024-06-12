<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Class Product
 *
 * @property int $id
 * @property string $product_name_and_brand
 * @property string $price_unit
 * @property string $product_description
 * @property int $stock
 * @property int $suppliers_id
 * @property bool $enabled
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property Supplier $supplier
 */
class Product extends Model
{
    protected $fillable = [
        'product_name_and_brand', 
        'price_unit', 
        'product_description', 
        'stock', 
        'suppliers_id', 
        'enabled'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'suppliers_id');
    }

    /**
     * Boot method to listen to model events.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            $validator = Validator::make($product->toArray(), [
                'stock' => 'integer|min:0',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
        });
    }
}

