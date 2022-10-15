<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Ingredient;

class IngredientApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_ingredient()
    {
        $ingredient = Ingredient::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/ingredients', $ingredient
        );

        $this->assertApiResponse($ingredient);
    }

    /**
     * @test
     */
    public function test_read_ingredient()
    {
        $ingredient = Ingredient::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/ingredients/'.$ingredient->id
        );

        $this->assertApiResponse($ingredient->toArray());
    }

    /**
     * @test
     */
    public function test_update_ingredient()
    {
        $ingredient = Ingredient::factory()->create();
        $editedIngredient = Ingredient::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/ingredients/'.$ingredient->id,
            $editedIngredient
        );

        $this->assertApiResponse($editedIngredient);
    }

    /**
     * @test
     */
    public function test_delete_ingredient()
    {
        $ingredient = Ingredient::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/ingredients/'.$ingredient->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/ingredients/'.$ingredient->id
        );

        $this->response->assertStatus(404);
    }
}
