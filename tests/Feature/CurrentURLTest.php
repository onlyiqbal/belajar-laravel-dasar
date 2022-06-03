<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CurrentURLTest extends TestCase
{
    public function testURLCurrent(){
        $this->get('/url/current?name=iqbal')->assertSeeText('/url/current?name=iqbal');
    }

    public function testNamed(){
        $this->get('/redirect/named')->assertSeeText('/redirect/name/iqbal');
    }

    public function testAction(){
        $this->get('/url/action')->assertSeeText('/form');
    }
}
