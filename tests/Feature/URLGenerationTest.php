<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
    public function testURLCurrent()
    {
        $this->get("/url/current?name=Iqbal")
            ->assertSeeText("/url/current?name=Iqbal");
    }

    public function testURLNamed()
    {
        $this->get("/redirect/named")
            ->assertSeeText("/redirect/name/iqbal");
    }

    public function testURLAction()
    {
        $this->get("/url/action")
            ->assertSeeText("/form");
    }
}
