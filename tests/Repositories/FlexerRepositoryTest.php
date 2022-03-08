<?php namespace Tests\Repositories;

use App\Models\Flexer;
use App\Repositories\FlexerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class FlexerRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var FlexerRepository
     */
    protected $flexerRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->flexerRepo = \App::make(FlexerRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_flexer()
    {
        $flexer = Flexer::factory()->make()->toArray();

        $createdFlexer = $this->flexerRepo->create($flexer);

        $createdFlexer = $createdFlexer->toArray();
        $this->assertArrayHasKey('id', $createdFlexer);
        $this->assertNotNull($createdFlexer['id'], 'Created Flexer must have id specified');
        $this->assertNotNull(Flexer::find($createdFlexer['id']), 'Flexer with given id must be in DB');
        $this->assertModelData($flexer, $createdFlexer);
    }

    /**
     * @test read
     */
    public function test_read_flexer()
    {
        $flexer = Flexer::factory()->create();

        $dbFlexer = $this->flexerRepo->find($flexer->id);

        $dbFlexer = $dbFlexer->toArray();
        $this->assertModelData($flexer->toArray(), $dbFlexer);
    }

    /**
     * @test update
     */
    public function test_update_flexer()
    {
        $flexer = Flexer::factory()->create();
        $fakeFlexer = Flexer::factory()->make()->toArray();

        $updatedFlexer = $this->flexerRepo->update($fakeFlexer, $flexer->id);

        $this->assertModelData($fakeFlexer, $updatedFlexer->toArray());
        $dbFlexer = $this->flexerRepo->find($flexer->id);
        $this->assertModelData($fakeFlexer, $dbFlexer->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_flexer()
    {
        $flexer = Flexer::factory()->create();

        $resp = $this->flexerRepo->delete($flexer->id);

        $this->assertTrue($resp);
        $this->assertNull(Flexer::find($flexer->id), 'Flexer should not exist in DB');
    }
}
