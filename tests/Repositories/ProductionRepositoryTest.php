<?php namespace Tests\Repositories;

use App\Models\Production;
use App\Repositories\ProductionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProductionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProductionRepository
     */
    protected $productionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->productionRepo = \App::make(ProductionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_production()
    {
        $production = Production::factory()->make()->toArray();

        $createdProduction = $this->productionRepo->create($production);

        $createdProduction = $createdProduction->toArray();
        $this->assertArrayHasKey('id', $createdProduction);
        $this->assertNotNull($createdProduction['id'], 'Created Production must have id specified');
        $this->assertNotNull(Production::find($createdProduction['id']), 'Production with given id must be in DB');
        $this->assertModelData($production, $createdProduction);
    }

    /**
     * @test read
     */
    public function test_read_production()
    {
        $production = Production::factory()->create();

        $dbProduction = $this->productionRepo->find($production->id);

        $dbProduction = $dbProduction->toArray();
        $this->assertModelData($production->toArray(), $dbProduction);
    }

    /**
     * @test update
     */
    public function test_update_production()
    {
        $production = Production::factory()->create();
        $fakeProduction = Production::factory()->make()->toArray();

        $updatedProduction = $this->productionRepo->update($fakeProduction, $production->id);

        $this->assertModelData($fakeProduction, $updatedProduction->toArray());
        $dbProduction = $this->productionRepo->find($production->id);
        $this->assertModelData($fakeProduction, $dbProduction->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_production()
    {
        $production = Production::factory()->create();

        $resp = $this->productionRepo->delete($production->id);

        $this->assertTrue($resp);
        $this->assertNull(Production::find($production->id), 'Production should not exist in DB');
    }
}
