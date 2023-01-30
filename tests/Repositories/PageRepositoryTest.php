<?php namespace Tests\Repositories;

use App\Models\Page;
use App\Repositories\PageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PageRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PageRepository
     */
    protected $pageRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->pageRepo = \App::make(PageRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_page()
    {
        $page = Page::factory()->make()->toArray();

        $createdPage = $this->pageRepo->create($page);

        $createdPage = $createdPage->toArray();
        $this->assertArrayHasKey('id', $createdPage);
        $this->assertNotNull($createdPage['id'], 'Created Page must have id specified');
        $this->assertNotNull(Page::find($createdPage['id']), 'Page with given id must be in DB');
        $this->assertModelData($page, $createdPage);
    }

    /**
     * @test read
     */
    public function test_read_page()
    {
        $page = Page::factory()->create();

        $dbPage = $this->pageRepo->find($page->id);

        $dbPage = $dbPage->toArray();
        $this->assertModelData($page->toArray(), $dbPage);
    }

    /**
     * @test update
     */
    public function test_update_page()
    {
        $page = Page::factory()->create();
        $fakePage = Page::factory()->make()->toArray();

        $updatedPage = $this->pageRepo->update($fakePage, $page->id);

        $this->assertModelData($fakePage, $updatedPage->toArray());
        $dbPage = $this->pageRepo->find($page->id);
        $this->assertModelData($fakePage, $dbPage->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_page()
    {
        $page = Page::factory()->create();

        $resp = $this->pageRepo->delete($page->id);

        $this->assertTrue($resp);
        $this->assertNull(Page::find($page->id), 'Page should not exist in DB');
    }
}
