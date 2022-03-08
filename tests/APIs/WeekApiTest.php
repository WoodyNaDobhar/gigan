<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Week;

class WeekApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_week()
    {
        $week = Week::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/weeks', $week
        );

        $this->assertApiResponse($week);
    }

    /**
     * @test
     */
    public function test_read_week()
    {
        $week = Week::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/weeks/'.$week->id
        );

        $this->assertApiResponse($week->toArray());
    }

    /**
     * @test
     */
    public function test_update_week()
    {
        $week = Week::factory()->create();
        $editedWeek = Week::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/weeks/'.$week->id,
            $editedWeek
        );

        $this->assertApiResponse($editedWeek);
    }

    /**
     * @test
     */
    public function test_delete_week()
    {
        $week = Week::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/weeks/'.$week->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/weeks/'.$week->id
        );

        $this->response->assertStatus(404);
    }
}
