<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testSession(){
        $this->get('/session/create')
        ->assertSeeText('OK')
        ->assertSessionHas('userId')
        ->assertSessionHas('isMember');
    }

    public function testGetSessionSuccess(){
        $this->withSession([
            'userId' => 'iqbal',
            'isMember' => 'true'
        ])->get('/session/get')
        ->assertSeeText('User Id : iqbal Is Member : true');
    }

    public function testGetSessionFaild(){
        $this->withSession([

        ])->get('/session/get')
        ->assertSeeText('User Id : guest Is Member : false');
    }
}
