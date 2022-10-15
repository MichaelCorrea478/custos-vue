<?php namespace Tests\Repositories;

use App\Models\Income;
use App\Repositories\IncomeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class IncomeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var IncomeRepository
     */
    protected $incomeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->incomeRepo = \App::make(IncomeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_income()
    {
        $income = Income::factory()->make()->toArray();

        $createdIncome = $this->incomeRepo->create($income);

        $createdIncome = $createdIncome->toArray();
        $this->assertArrayHasKey('id', $createdIncome);
        $this->assertNotNull($createdIncome['id'], 'Created Income must have id specified');
        $this->assertNotNull(Income::find($createdIncome['id']), 'Income with given id must be in DB');
        $this->assertModelData($income, $createdIncome);
    }

    /**
     * @test read
     */
    public function test_read_income()
    {
        $income = Income::factory()->create();

        $dbIncome = $this->incomeRepo->find($income->id);

        $dbIncome = $dbIncome->toArray();
        $this->assertModelData($income->toArray(), $dbIncome);
    }

    /**
     * @test update
     */
    public function test_update_income()
    {
        $income = Income::factory()->create();
        $fakeIncome = Income::factory()->make()->toArray();

        $updatedIncome = $this->incomeRepo->update($fakeIncome, $income->id);

        $this->assertModelData($fakeIncome, $updatedIncome->toArray());
        $dbIncome = $this->incomeRepo->find($income->id);
        $this->assertModelData($fakeIncome, $dbIncome->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_income()
    {
        $income = Income::factory()->create();

        $resp = $this->incomeRepo->delete($income->id);

        $this->assertTrue($resp);
        $this->assertNull(Income::find($income->id), 'Income should not exist in DB');
    }
}
