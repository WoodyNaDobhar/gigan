<?php namespace Tests\Repositories;

use App\Models\Week;
use App\Repositories\WeekRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class WeekRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var WeekRepository
     */
    protected $weekRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->weekRepo = \App::make(WeekRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_week()
    {
        $week = Week::factory()->make()->toArray();

        $createdWeek = $this->weekRepo->create($week);

        $createdWeek = $createdWeek->toArray();
        $this->assertArrayHasKey('id', $createdWeek);
        $this->assertNotNull($createdWeek['id'], 'Created Week must have id specified');
        $this->assertNotNull(Week::find($createdWeek['id']), 'Week with given id must be in DB');
        $this->assertModelData($week, $createdWeek);
    }

    /**
     * @test read
     */
    public function test_read_week()
    {
        $week = Week::factory()->create();

        $dbWeek = $this->weekRepo->find($week->id);

        $dbWeek = $dbWeek->toArray();
        $this->assertModelData($week->toArray(), $dbWeek);
    }

    /**
     * @test update
     */
    public function test_update_week()
    {
        $week = Week::factory()->create();
        $fakeWeek = Week::factory()->make()->toArray();

        $updatedWeek = $this->weekRepo->update($fakeWeek, $week->id);

        $this->assertModelData($fakeWeek, $updatedWeek->toArray());
        $dbWeek = $this->weekRepo->find($week->id);
        $this->assertModelData($fakeWeek, $dbWeek->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_week()
    {
        $week = Week::factory()->create();

        $resp = $this->weekRepo->delete($week->id);

        $this->assertTrue($resp);
        $this->assertNull(Week::find($week->id), 'Week should not exist in DB');
    }
}
