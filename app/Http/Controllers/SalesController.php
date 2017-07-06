<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Sales;
use Response;

class SalesController extends Controller
{
    protected $respose;
 
    public function __construct(Response $response)
    {
        $this->Sales = new Sales;
        $this->response = $response;
    }
 
    public function index()
    {
        //Get all Sales with Seller
        return $this->Sales->getWithSeller()->get();
    }

    public function show( int $id )
    {
        //Get a Sale with Seller
        $show = $this->Sales->getWithSeller()->whereId( $id )->first();
        // Check Sale exist
        if( is_null($show) )
            return Response::json(['error' => 'Sale Not Found'], 404);
        return $show;
    }

    public function store(Request $request)
    {
        $inputs = $request->input();   
        // The seller is valid, store in database...
        $valitator = $this->Sales->valitator( $inputs );

        if( $valitator['fails'] )
            return Response::json($valitator, 400);
        
       return Response::json( $this->Sales->newStore( $inputs ) );
    }
}
