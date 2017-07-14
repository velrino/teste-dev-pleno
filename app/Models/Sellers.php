<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sellers extends Model
{
    protected $fillable = ['name', 'email'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function sales()
    {
        return $this->hasMany("App\Models\Sales", "seller_id", "id");
    }
}
