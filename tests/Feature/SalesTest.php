<?php

namespace Tests\Feature;

use Faker;
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
        $seller = factory(\App\Models\Sellers::class)->create();
        $faker = Faker\Factory::create();
        $price = $faker->numerify('###.##');

        $response = $this->json('POST', 
            '/api/sales', 
            [
                'seller_id' => $seller->id,
                'price' => $price,
        ]);
         $response->assertJsonStructure([
             'data' => [
                'id',
                'price',
                'commission',
                'created_at',
                'seller' => [
                    'id',
                    'name',
                    'email'
                ]
        ]]);

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
             'data' =>  [
             '*' => [
                'id',
                'price',
                'commission',
                'seller' => [
                    'id',
                    'name',
                    'email',
                ],
            ]
        ]]);

        $response->assertStatus(200);
    }
    /**
     * A basic test about success in show.
     *
     * @return void
     */
    public function testShowSuccess()
    {


        $response = $this->get("/api/sales/1");

         $response->assertJsonStructure([
            'data' =>  [
            'id',
            'price',
            'commission',
            'seller' => [
                'id',
                'name',
                'email',
            ]
        ]]);

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
