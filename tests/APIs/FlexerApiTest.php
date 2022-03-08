<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Flexer;

class FlexerApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_flexer()
    {
        $flexer = Flexer::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/flexers', $flexer
        );

        $this->assertApiResponse($flexer);
    }

    /**
     * @test
     */
    public function test_read_flexer()
    {
        $flexer = Flexer::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/flexers/'.$flexer->id
        );

        $this->assertApiResponse($flexer->toArray());
    }

    /**
     * @test
     */
    public function test_update_flexer()
    {
        $flexer = Flexer::factory()->create();
        $editedFlexer = Flexer::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/flexers/'.$flexer->id,
            $editedFlexer
        );

        $this->assertApiResponse($editedFlexer);
    }

    /**
     * @test
     */
    public function test_delete_flexer()
    {
        $flexer = Flexer::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/flexers/'.$flexer->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/flexers/'.$flexer->id
        );

        $this->response->assertStatus(404);
    }
}
