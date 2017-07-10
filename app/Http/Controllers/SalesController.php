<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Transformers\SalesTransformer;

class SalesController extends ApiController
{
    public function __construct()
    {
        $this->Model = new Sales;
    }
 
    public function index()
    {
        //Get all Sales with Seller
        return $this->Collection( $this->Model->all(), new SalesTransformer )->ApiResponse();
    }

    public function show( int $id )
    {
        //Get a Sale with Seller
        $show = $this->Model->getWithSeller()->whereId( $id )->first();
        // Check Sale exist
        if( is_null($show) )
            return $this->ApiResponseHandling(['errros' => 'Seller Not Found'], 404);
        return $this->Item( $show, new SalesTransformer )->ApiResponse();
    }

    public function store(Request $request)
    {
        $inputs = $request->input();   
        // The seller is valid, store in database...
        $valitator = $this->Model->valitator( $inputs );
        if( $valitator['fails'] )
            return $this->ApiResponseHandling($valitator, 400);
        // Store data
        $store = $this->Model->newStore( $inputs );
        return $this->Item( $store, new SalesTransformer )->ApiResponse();
    }
}
