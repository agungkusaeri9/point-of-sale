<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $table = 'sale_details';
    protected $guarded = ['id'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
