<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SellersTest extends TestCase
{
    /**
     * A basic test about success in store.
     *
     * @return void
     */
    public function testStoreSuccess()
    {
        $response = $this->json('POST', 
            '/api/sellers', 
            [
                'name' => 'Sally',
                'email' => 'name@email.com'
        ]);
         $response->assertJsonStructure([
             'data' => [
                'id',
                'name',
                'email',
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
            '/api/sellers', 
            [
                'name' => 'Sally',
                'email' => 'nameemail.com'
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
        $response = $this->get('/api/sellers');

         $response->assertJsonStructure([
             'data' => [
             '*' => [
                'id',
                'name',
                'email',
                'commission',
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
        $sale = factory(\App\Models\Sales::class)->create();
        $response = $this->get("/api/sellers/$sale->seller_id");

        $response->assertStatus(200);
    }
    /**
     * A basic test about not found in show.
     *
     * @return void
     */
    public function testShowNotFound()
    {
        $response = $this->get('/api/sellers/69696969');

        $response->assertStatus(404);
    }
}
