<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable=[
      'name','price','date','user_id','status','use'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
