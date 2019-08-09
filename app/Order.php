<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['date','user_id','product_id'];
    protected $hidden = ['product_id','user_id'];

    public function product(){
        $this->belongsTo(Product::class);
    }
    public function user(){
        $this->belongsTo(User::class);
    }
}
