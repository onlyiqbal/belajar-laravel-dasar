<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse(){
        $this->get('/response/hello')
        ->assertStatus(200)
        ->assertSeeText('Hello Response');
    }

    public function testHeader(){
        $this->get('/response/header')
        ->assertStatus(200)
        ->assertSeeText('iqbal')
        ->assertSeeText('maulana')
        ->assertSeeText('menggala')
        ->assertHeader('Content-Type','application/json')
        ->assertHeader('Author','iqbal')
        ->assertHeader('App','Belajar Laravel Dasar');
    }

    public function testResponseTypeView(){
        $this->get('/response/type/view')
        ->assertSeeText('Hello iqbal');
    }

    public function testResponseTypeJson(){
        $this->get('/response/type/json')
        ->assertJson([
            'firstName' => 'iqbal',
            'middleName' => 'maulana',
            'lastName' => 'menggala'
        ]);
    }

    public function testResponseTypeFile(){
        $this->get('/response/type/file')
        ->assertHeader('Content-Type','image/png');
    }

    public function testResponseTypeDownload(){
        $this->get('/response/type/download')
        ->assertDownload('logoumika.png');
    }
}
