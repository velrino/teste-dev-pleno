<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Support\Facades\Cache;
use DB;

class Sellers extends Model
{
    protected $fillable = ['name', 'email'];

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

    public function newStore( array $input )
    {        
        return $this->create($input);
    }

    public function getSeller( int $id )
    {
        return Cache::remember('getSeller', 30, function() use( $id) {
            return $this::select('sellers.id', 'name', 'email', DB::raw('SUM(commission) as commission'))
                                ->join('sales', 'sellers.id', '=', 'sales.seller_id')
                                ->groupBy('sellers.id')
                                ->where( 'sellers.id', $id )
                                ->first();
        });
    }

    public function sellersWithCommission()
    {
        return Cache::remember('sellersWithCommission', 30, function(){
            return $this::select('sellers.id', 'name', 'email', DB::raw('SUM(commission) as commission'))
                                ->join('sales', 'sellers.id', '=', 'sales.seller_id')
                                ->groupBy('sellers.id')
                                ->get();
        });
    }



    public function sales()
    {
        return $this->hasMany("App\Models\Sales", "seller_id", "id");
    }
}
