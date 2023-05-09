<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
      'brand_id',
      'category_id',
      'user_id',
        'slug',
      'title_fa',
      'title_en',
      'colors',
      'gr',
      'forosh',
      'price',
      'takhfif',
      'image1',
      'image2',
      'image3',
      'image4',
      'description',
      'attributes'  ,
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function tags_product()
    {
        return $this->tags()->pluck('tag_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function callapses()
    {
        return $this->hasMany(Collapse::class)->where('status',1);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->where('status',1)->where('child',null);
    }

    public function markets()
    {
        return $this->belongsToMany(Market::class);
    }


    public function explode($array)
    {
        return explode('-',$array);
    }



    public function parcent ($price,$newprice)
    {
      return (($price-$newprice) * 100) /$price;
    }

    public function newprice($price,$newprice)
    {
        return $price-($price* ($this->parcent($price,$newprice) / 100));
    }

    public function scopeSearched($query)
    {
        $search = request()->query('search');
        if(!$search){
            return $query;
        }else{
           return $query->where('title_fa','LIKE',"%{$search}%");
        }
    }
}
