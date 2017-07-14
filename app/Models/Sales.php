<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $fillable = ['seller_id', 'price', 'commission'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];   
    
    public function seller()
    {
        return $this->hasOne("App\Models\Sellers", "id", "seller_id")->select(['id', 'name', 'email']);
    }
}
