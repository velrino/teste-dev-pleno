<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Repositories\SalesRepository;
use App\Transformers\SalesTransformer;

class SalesController extends ApiController
{
    private $repository;

    private $transformer;

    public function __construct(SalesRepository $repository, SalesTransformer $transformer)
    {
        $this->repository = $repository;
        $this->transformer = $transformer;
    }
 
    public function index()
    {
        return $this->Collection($this->repository->findAll(),$this->transformer)->ApiResponse();
    }

    public function show(int $id)
    {
        $show = $this->repository->findOrFail($id);

        if(is_null($show))
        {
            return $this->ApiResponseHandling(['errros' => 'Seller Not Found'], 404);
        }
        return $this->Item($show,$this->transformer)->ApiResponse();
    }

    public function store(Request $request)
    {
        $inputs = $request->input();   
        
        $valitator = $this->repository->valitator($inputs);
        
        if($valitator['fails'])
        {
            return $this->ApiResponseHandling($valitator, 400);
        }
        $store = $this->repository->create($inputs);
        return $this->Item($store,$this->transformer)->ApiResponse();
    }
}
