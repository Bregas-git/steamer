<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const PRODUCT_APPROVAL_WAIT = 1;
    const PRODUCT_APPROVAL_ACCEPTED = 2;
    const PRODUCT_APPROVAL_REJECTED = 3;

    public function categoryProduct()
    {
        return $this->hasMany(CategoryProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
