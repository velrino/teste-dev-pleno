<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Sellers;
use App\Http\Requests\SellerRequest;
use App\Transformers\SellerTransformer;
use Mail;
use Response;
use App\Mail\Remider as Remider;

class SellersController extends Controller
{
    protected $respose;
 
    public function __construct(Response $response)
    {
        $this->Sellers = new Sellers;
        $this->response = $response;
    }
    
    public function index()
    {
        //Get all Sellers with Sellers
        return $this->Sellers->select('id', 'name', 'email', 'commission')->get();
    }


    public function show( int $id )
    {
        //Get a Seller with Sellers
        $show = $this->Sellers->getWithSales()->whereId( $id )->first();
        // Check Seller exist
        if( is_null($show) )
            return Response::json(['error' => 'Seller Not Found'], 404);
        return $show;
    }

    public function store(Request $request)
    {
        $inputs = $request->input();   
        // The seller is valid, store in database...
        $valitator = $this->Sellers->valitator( $inputs );
        if( $valitator['fails'] )
            return Response::json($valitator, 400);
            
       return Response::json( $this->Sellers->newStore( $inputs ) );
    }

}
