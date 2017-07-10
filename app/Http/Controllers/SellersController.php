<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Sellers;
use App\Transformers\SellerTransformer;

class SellersController extends ApiController
{
    public function __construct()
    {
        $this->Model = new Sellers;
    }
    
    public function index()
    {
        //Get all Sellers with Commission
        return $this->Collection( $this->Model->sellersWithCommission(), new SellerTransformer )->ApiResponse();
    }

    public function show( int $id )
    {
        //Get a Seller with Sellers
        $show = $this->Model->getSeller( $id );
        // Check Seller exist
        if( is_null($show) )
            return $this->ApiResponseHandling(['errros' => 'Seller Not Found'], 404);
        return $this->Item( $show, new SellerTransformer )->ApiResponse();
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
        return $this->Item( $store, new SellerTransformer )->ApiResponse();
    }
}
