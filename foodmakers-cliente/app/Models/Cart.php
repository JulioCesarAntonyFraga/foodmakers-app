<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['total_price', 'user_id', 'ordered', 'phone', 'address', 'cupon', 'observations', 'payment_method'];

    public function products()
    {
        return $this->hasMany(CartProduct::class);
    }
}
