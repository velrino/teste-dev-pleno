<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
use App\Models\Sellers;

class Sales extends Model
{
    protected $fillable = ['seller_id', 'price', 'commission'];

    public $rules = [
        'seller_id' => 'required|exists:sellers,id',
        'price' => 'required',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];    
    
    public function valitator( $inputs )
    {
       $validator = Validator::make($inputs, $this->rules);
       return [
           'fails' => $validator->fails(),
           'errros' => $validator->errors()->toArray()
       ];
    }

    public function newStore( array $input )
    {
        return $this->create($input);
    }

    public function getWithSeller()
    {
        return $this::with('seller');
    }

    public function seller()
    {
        return $this->hasOne("App\Models\Sellers", "id", "seller_id")->select(['id', 'name', 'email']);
    }
}
