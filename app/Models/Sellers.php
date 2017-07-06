<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Sellers extends Model
{
    public $rules = [
        'email' => 'required|email',
        'name' => 'required',
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
        $this->name = $input['name'];
        $this->email = $input['email'];
        $this->commission = '8.5';
        $this->save();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email
        ];
    }
    
    public function getWithSales()
    {
        return $this::with('sales');
    }

    public function sales()
    {
        return $this->hasMany("App\Models\Sales", "seller_id", "id");
    }
}
