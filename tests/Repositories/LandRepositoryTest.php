<?php namespace Tests\Repositories;

use App\Models\Land;
use App\Repositories\LandRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class LandRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var LandRepository
     */
    protected $landRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->landRepo = \App::make(LandRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_land()
    {
        $land = Land::factory()->make()->toArray();

        $createdLand = $this->landRepo->create($land);

        $createdLand = $createdLand->toArray();
        $this->assertArrayHasKey('id', $createdLand);
        $this->assertNotNull($createdLand['id'], 'Created Land must have id specified');
        $this->assertNotNull(Land::find($createdLand['id']), 'Land with given id must be in DB');
        $this->assertModelData($land, $createdLand);
    }

    /**
     * @test read
     */
    public function test_read_land()
    {
        $land = Land::factory()->create();

        $dbLand = $this->landRepo->find($land->id);

        $dbLand = $dbLand->toArray();
        $this->assertModelData($land->toArray(), $dbLand);
    }

    /**
     * @test update
     */
    public function test_update_land()
    {
        $land = Land::factory()->create();
        $fakeLand = Land::factory()->make()->toArray();

        $updatedLand = $this->landRepo->update($fakeLand, $land->id);

        $this->assertModelData($fakeLand, $updatedLand->toArray());
        $dbLand = $this->landRepo->find($land->id);
        $this->assertModelData($fakeLand, $dbLand->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_land()
    {
        $land = Land::factory()->create();

        $resp = $this->landRepo->delete($land->id);

        $this->assertTrue($resp);
        $this->assertNull(Land::find($land->id), 'Land should not exist in DB');
    }
}
