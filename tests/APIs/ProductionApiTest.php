<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Production;

class ProductionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_production()
    {
        $production = Production::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/productions', $production
        );

        $this->assertApiResponse($production);
    }

    /**
     * @test
     */
    public function test_read_production()
    {
        $production = Production::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/productions/'.$production->id
        );

        $this->assertApiResponse($production->toArray());
    }

    /**
     * @test
     */
    public function test_update_production()
    {
        $production = Production::factory()->create();
        $editedProduction = Production::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/productions/'.$production->id,
            $editedProduction
        );

        $this->assertApiResponse($editedProduction);
    }

    /**
     * @test
     */
    public function test_delete_production()
    {
        $production = Production::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/productions/'.$production->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/productions/'.$production->id
        );

        $this->response->assertStatus(404);
    }
}
