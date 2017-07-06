<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
use App\Models\Sellers;
use Carbon\Carbon;

class Sales extends Model
{
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

    public function newStore( $input )
    {
        $Seller =  Sellers::find($input['seller_id']);
        $this->price = $input['price'];
        $this->commission = $Seller->commission;
        $this->seller_id = $input['seller_id'];
        $this->save();
        return [
                'id' => $this->id,
                'name' => $Seller->name,
                'email' => $Seller->email,
                'price' => $this->price,
                'commission' => $this->commission,
                'sale_date' => $this->created_at->toDateTimeString(),
        ];
    }

    public function getWithSeller()
    {
        return $this::with('seller');
    }

    public function seller()
    {
        return $this->hasOne("App\Models\Sellers", "id", "seller_id")->select(['id', 'name', 'email', 'commission']);
    }
}
