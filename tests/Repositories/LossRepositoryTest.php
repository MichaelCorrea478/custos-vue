<?php namespace Tests\Repositories;

use App\Models\Loss;
use App\Repositories\LossRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class LossRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var LossRepository
     */
    protected $lossRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->lossRepo = \App::make(LossRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_loss()
    {
        $loss = Loss::factory()->make()->toArray();

        $createdLoss = $this->lossRepo->create($loss);

        $createdLoss = $createdLoss->toArray();
        $this->assertArrayHasKey('id', $createdLoss);
        $this->assertNotNull($createdLoss['id'], 'Created Loss must have id specified');
        $this->assertNotNull(Loss::find($createdLoss['id']), 'Loss with given id must be in DB');
        $this->assertModelData($loss, $createdLoss);
    }

    /**
     * @test read
     */
    public function test_read_loss()
    {
        $loss = Loss::factory()->create();

        $dbLoss = $this->lossRepo->find($loss->id);

        $dbLoss = $dbLoss->toArray();
        $this->assertModelData($loss->toArray(), $dbLoss);
    }

    /**
     * @test update
     */
    public function test_update_loss()
    {
        $loss = Loss::factory()->create();
        $fakeLoss = Loss::factory()->make()->toArray();

        $updatedLoss = $this->lossRepo->update($fakeLoss, $loss->id);

        $this->assertModelData($fakeLoss, $updatedLoss->toArray());
        $dbLoss = $this->lossRepo->find($loss->id);
        $this->assertModelData($fakeLoss, $dbLoss->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_loss()
    {
        $loss = Loss::factory()->create();

        $resp = $this->lossRepo->delete($loss->id);

        $this->assertTrue($resp);
        $this->assertNull(Loss::find($loss->id), 'Loss should not exist in DB');
    }
}
