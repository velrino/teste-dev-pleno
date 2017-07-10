<?php
 
namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Sales;

class SalesTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        // 'author'
    ];

    public function transform( Sales $sale)
    {
        return [
            'id' => $sale->id,
            'price' => $sale->price,
            'commission' => $sale->commission,
            'created_at' => $sale->created_at->toDateTimeString(),
            'seler' => $sale->seller,
        ];
    }
}