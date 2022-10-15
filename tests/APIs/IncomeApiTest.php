<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Income;

class IncomeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_income()
    {
        $income = Income::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/incomes', $income
        );

        $this->assertApiResponse($income);
    }

    /**
     * @test
     */
    public function test_read_income()
    {
        $income = Income::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/incomes/'.$income->id
        );

        $this->assertApiResponse($income->toArray());
    }

    /**
     * @test
     */
    public function test_update_income()
    {
        $income = Income::factory()->create();
        $editedIncome = Income::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/incomes/'.$income->id,
            $editedIncome
        );

        $this->assertApiResponse($editedIncome);
    }

    /**
     * @test
     */
    public function test_delete_income()
    {
        $income = Income::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/incomes/'.$income->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/incomes/'.$income->id
        );

        $this->response->assertStatus(404);
    }
}
