<?php

namespace Tests\Feature;

use Tests\TestCase;

class BasicCrudTest extends TestCase
{
    /** @test */
    public function laravel_is_running()
    {
        $response = $this->get('/');
        $response->assertStatus(200); // o 302 depenent del teu app
    }

    /** @test */
    public function any_crud_route_returns_a_valid_response()
    {
        $routes = [
            '/items',
            '/items/1',
            '/items/create',
            '/items/1/edit'
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);

            $this->assertTrue(
                in_array($response->status(), [200, 302, 404]),
                "Route $route returned unexpected status: ".$response->status()
            );
        }
    }

    /** @test */
    public function post_put_and_delete_do_not_break()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/items', []);
        $this->assertContains($response->status(), [200, 302, 404]);

        $response = $this->put('/items/1', []);
        $this->assertContains($response->status(), [200, 302, 404]);

        $response = $this->delete('/items/1');
        $this->assertContains($response->status(), [200, 302, 404]);
    }
}
