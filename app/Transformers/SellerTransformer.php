<?php
 
namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Sellers;

class SellerTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        // 'author'
    ];

    public function transform( Sellers $seller)
    {
        return [
            'id' => $seller->id,
            'name' => $seller->name,
            'email' => $seller->email,
            'commission' => $seller->commission,
        ];
    }
}