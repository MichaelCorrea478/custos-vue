<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Loss;

class LossApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_loss()
    {
        $loss = Loss::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/losses', $loss
        );

        $this->assertApiResponse($loss);
    }

    /**
     * @test
     */
    public function test_read_loss()
    {
        $loss = Loss::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/losses/'.$loss->id
        );

        $this->assertApiResponse($loss->toArray());
    }

    /**
     * @test
     */
    public function test_update_loss()
    {
        $loss = Loss::factory()->create();
        $editedLoss = Loss::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/losses/'.$loss->id,
            $editedLoss
        );

        $this->assertApiResponse($editedLoss);
    }

    /**
     * @test
     */
    public function test_delete_loss()
    {
        $loss = Loss::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/losses/'.$loss->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/losses/'.$loss->id
        );

        $this->response->assertStatus(404);
    }
}
