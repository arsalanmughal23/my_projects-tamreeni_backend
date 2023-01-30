<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Page;

class PageApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_page()
    {
        $page = Page::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/pages', $page
        );

        $this->assertApiResponse($page);
    }

    /**
     * @test
     */
    public function test_read_page()
    {
        $page = Page::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/pages/'.$page->id
        );

        $this->assertApiResponse($page->toArray());
    }

    /**
     * @test
     */
    public function test_update_page()
    {
        $page = Page::factory()->create();
        $editedPage = Page::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/pages/'.$page->id,
            $editedPage
        );

        $this->assertApiResponse($editedPage);
    }

    /**
     * @test
     */
    public function test_delete_page()
    {
        $page = Page::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/pages/'.$page->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/pages/'.$page->id
        );

        $this->response->assertStatus(404);
    }
}
