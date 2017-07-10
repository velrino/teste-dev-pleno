<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SalesTest extends TestCase
{
    /**
     * A basic test about success in store.
     *
     * @return void
     */
    public function testStoreSuccess()
    {
        $response = $this->json('POST', 
            '/api/sales', 
            [
                'seller_id' => '1',
                'price' => '22.90'
        ]);
         $response->assertJsonStructure([
            'id',
            'name',
            'email',
            'price',
            'commission',
            'sale_date',
        ]);

        $response->assertStatus(200);

    }
    /**
     * A basic test about bad request in store.
     *
     * @return void
     */
    public function testStoreBadRequest()
    {
        $response = $this->json('POST', 
            '/api/sales', 
            [
                'seller_id' => '99999999999',
                'price' => 'i21i2921'
        ]);

        $response->assertStatus(400);
    }
    /**
     * A basic test about success in index.
     *
     * @return void
     */
    public function testIndexSuccess()
    {
        $response = $this->get('/api/sales');

         $response->assertJsonStructure([
             '*' => [
                'id',
                'seller_id',
                'seller' => [
                    'id',
                    'name',
                    'email',
                    'commission'
                ],
                'price',
                'commission',
            ]
        ]);

        $response->assertStatus(200);
    }
    /**
     * A basic test about success in show.
     *
     * @return void
     */
    public function testShowSuccess()
    {
        $response = $this->get('/api/sales/1');

        $response->assertStatus(200);
    }
    /**
     * A basic test about not found in show.
     *
     * @return void
     */
    public function testShowNotFound()
    {
        $response = $this->get('/api/sales/69696969');

        $response->assertStatus(404);
    }
}
