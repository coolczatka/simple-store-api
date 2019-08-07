<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['url','price','description'];
    protected $hidden = ['created_at', 'updated_at','id'];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
