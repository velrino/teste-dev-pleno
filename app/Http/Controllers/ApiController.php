<?php

namespace App\Http\Controllers;

use Response;

class ApiController extends Controller
{
    private $response;

    private function Fractal()
    {
        return new \League\Fractal\Manager();
    }

    protected function Collection( $data, $transform )
    {
        $this->response = new \League\Fractal\Resource\Collection( $data, $transform );
        return $this;
    }

    protected function Item( $data, $transform )
    {
        $this->response = new \League\Fractal\Resource\Item( $data, $transform );
        return $this;
    }

    protected function ApiResponse( )
    {
        return $this->fractal()->createData( $this->response )->toArray();
    }
    
    protected function ApiResponseHandling( $array, $code = 200 )
    {
        return Response::json( $array , $code );
    }
}
