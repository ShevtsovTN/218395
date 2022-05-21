<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_validation_request()
    {
        $data = [];
        $response = $this->post(route('users.index'), $data, [
            'Authorization' => config('app_key.access_key')
        ]);

        $response->assertStatus(200);
    }
}
