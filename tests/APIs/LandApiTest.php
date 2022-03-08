<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Land;

class LandApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_land()
    {
        $land = Land::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/lands', $land
        );

        $this->assertApiResponse($land);
    }

    /**
     * @test
     */
    public function test_read_land()
    {
        $land = Land::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/lands/'.$land->id
        );

        $this->assertApiResponse($land->toArray());
    }

    /**
     * @test
     */
    public function test_update_land()
    {
        $land = Land::factory()->create();
        $editedLand = Land::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/lands/'.$land->id,
            $editedLand
        );

        $this->assertApiResponse($editedLand);
    }

    /**
     * @test
     */
    public function test_delete_land()
    {
        $land = Land::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/lands/'.$land->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/lands/'.$land->id
        );

        $this->response->assertStatus(404);
    }
}
