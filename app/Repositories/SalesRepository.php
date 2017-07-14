<?php

namespace App\Repositories;

use App\Models\Sales;
use Validator;

class SalesRepository extends Repository
{
    
    public $rules = [
        'seller_id' => 'required|exists:sellers,id',
        'price' => 'required',
    ];

	public function __construct(Sales $model)
	{
		$this->model = $model;
	}
            
    public function valitator( $inputs )
    {
       $validator = Validator::make($inputs, $this->rules);
       return [
           'fails' => $validator->fails(),
           'errros' => $validator->errors()->toArray()
       ];
    }


}