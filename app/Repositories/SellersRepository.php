<?php

namespace App\Repositories;

use App\Models\Sellers;
use Validator;

class SellersRepository extends Repository
{
    
    public $rules = [
        'email' => 'required|email',
        'name' => 'required',
    ];

	public function __construct(Sellers $model)
	{
		$this->model = $model;
	}
            
    public function valitator($inputs)
    {
       $validator = Validator::make($inputs,$this->rules);
       return [
           'fails' => $validator->fails(),
           'errros' => $validator->errors()->toArray()
       ];
    }

    public function findAll()
    {
        return \Cache::remember('sellersWithCommission', 30, function(){
            return $this->model::select('sellers.id', 'name', 'email', \DB::raw('SUM(commission) as commission'))
                                ->join('sales', 'sellers.id', '=', 'sales.seller_id')
                                ->groupBy('sellers.id')
                                ->get();
        });
    }

    public function findOrFail(int $id)
    {
        return $this->model::select('sellers.id', 'name', 'email', \DB::raw('SUM(commission) as commission'))
                            ->join('sales', 'sellers.id', '=', 'sales.seller_id')
                            ->groupBy('sellers.id')
                            ->with('sales')
                            ->where('sellers.id',$id)
                            ->first();
    }
}