<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable=['product_id','status'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
