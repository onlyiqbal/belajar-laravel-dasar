<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    public function testGet()
    {
        $this->get('/iqbal')
            ->assertStatus(200)
            ->assertSeeText('Hello Iqbal Menggala');
    }

    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/iqbal');
    }

    public function testFallback()
    {
        $this->get("/tidakada")
            ->assertSeeText("404 by Iqbal");
    }

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText('Product 1');

        $this->get('/products/2')
            ->assertSeeText('Product 2');

        $this->get('/products/2/XXX')
            ->assertSeeText('Product 2, Item XXX');

        $this->get('/products/2/YYY')
            ->assertSeeText('Product 2, Item YYY');
    }

    public function testRouteParameterRegex()
    {
        $this->get('/categories/1')
            ->assertSeeText('Categories 1');

        $this->get('/categories/iqbal')
            ->assertSeeText('404 by Iqbal');
    }

    public function testRouteParameterOptional()
    {
        $this->get('/user/iqbal')
            ->assertSeeText('User iqbal');

        $this->get('/user/')
            ->assertSeeText('User 404');
    }

    public function testRouteConflict()
    {
        $this->get('/conflict/budi')
            ->assertSeeText('Conflict budi');

        $this->get('/conflict/iqbal')
            ->assertSeeText('Conflict Iqbal Menggala');
    }

    public function testNamedRoute()
    {
        $this->get('/produk/12345')
            ->assertSeeText('Link http://localhost/products/1234');

        $this->get('/produk-redirect/12345')
            ->assertRedirect('/products/12345');
    }
}