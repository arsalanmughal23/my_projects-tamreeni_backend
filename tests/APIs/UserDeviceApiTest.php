<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\UserDevice;

class UserDeviceApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_user_device()
    {
        $userDevice = UserDevice::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/user_devices', $userDevice
        );

        $this->assertApiResponse($userDevice);
    }

    /**
     * @test
     */
    public function test_read_user_device()
    {
        $userDevice = UserDevice::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/user_devices/'.$userDevice->id
        );

        $this->assertApiResponse($userDevice->toArray());
    }

    /**
     * @test
     */
    public function test_update_user_device()
    {
        $userDevice = UserDevice::factory()->create();
        $editedUserDevice = UserDevice::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/user_devices/'.$userDevice->id,
            $editedUserDevice
        );

        $this->assertApiResponse($editedUserDevice);
    }

    /**
     * @test
     */
    public function test_delete_user_device()
    {
        $userDevice = UserDevice::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/user_devices/'.$userDevice->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/user_devices/'.$userDevice->id
        );

        $this->response->assertStatus(404);
    }
}
