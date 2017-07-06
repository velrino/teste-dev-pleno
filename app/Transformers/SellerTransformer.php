<?php
 
namespace App\Transformers;
 
class SellerTransformer 
{
 
    public function transform($seller) {
        dd( $seller );
        return [
            'id' => $seller->id,
            'name' => $seller->name,
            'email' => $seller->email
        ];
    }
 
}