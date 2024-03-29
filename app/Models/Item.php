<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = ['id'];
    protected $primary = ['barcode'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function image()
    {
        if($this->image !== NULL)
        {
            return asset('storage/' . $this->image);
        }else{
            return 'https://via.placeholder.com/150';
        }
    }
}
