<?php namespace Tests\Repositories;

use App\Models\Ingredient;
use App\Repositories\IngredientRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class IngredientRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var IngredientRepository
     */
    protected $ingredientRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->ingredientRepo = \App::make(IngredientRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_ingredient()
    {
        $ingredient = Ingredient::factory()->make()->toArray();

        $createdIngredient = $this->ingredientRepo->create($ingredient);

        $createdIngredient = $createdIngredient->toArray();
        $this->assertArrayHasKey('id', $createdIngredient);
        $this->assertNotNull($createdIngredient['id'], 'Created Ingredient must have id specified');
        $this->assertNotNull(Ingredient::find($createdIngredient['id']), 'Ingredient with given id must be in DB');
        $this->assertModelData($ingredient, $createdIngredient);
    }

    /**
     * @test read
     */
    public function test_read_ingredient()
    {
        $ingredient = Ingredient::factory()->create();

        $dbIngredient = $this->ingredientRepo->find($ingredient->id);

        $dbIngredient = $dbIngredient->toArray();
        $this->assertModelData($ingredient->toArray(), $dbIngredient);
    }

    /**
     * @test update
     */
    public function test_update_ingredient()
    {
        $ingredient = Ingredient::factory()->create();
        $fakeIngredient = Ingredient::factory()->make()->toArray();

        $updatedIngredient = $this->ingredientRepo->update($fakeIngredient, $ingredient->id);

        $this->assertModelData($fakeIngredient, $updatedIngredient->toArray());
        $dbIngredient = $this->ingredientRepo->find($ingredient->id);
        $this->assertModelData($fakeIngredient, $dbIngredient->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_ingredient()
    {
        $ingredient = Ingredient::factory()->create();

        $resp = $this->ingredientRepo->delete($ingredient->id);

        $this->assertTrue($resp);
        $this->assertNull(Ingredient::find($ingredient->id), 'Ingredient should not exist in DB');
    }
}
