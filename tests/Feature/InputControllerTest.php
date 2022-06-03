<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput(){
        $this->get('/input/hello?name=iqbal')
        ->assertSeeText('Hello iqbal');

        $this->post('/input/hello', ['name' => 'Iqbal'])
        ->assertSeeText('Hello Iqbal');
    }

    public function testFirst(){
        $this->post('/hello/input/first',[
            'name' => [
                'first' => 'iqbal',
                'last' => 'menggala'
            ]
        ])->assertSeeText('Hello iqbal');
    }

    public function testInputAll(){
        $this->post('/input/hello/input',[
            'name' => [
                'first' => 'iqbal',
                'last' => 'menggala',
            ]
        ])
        ->assertSeeText('name')
        ->assertSeeText('first')
        ->assertSeeText('last')
        ->assertSeeText('iqbal')
        ->assertSeeText('menggala');
    }

    public function testArrayInput(){
        $this->post('/input/hello/array',[
            'products' => [
                [
                    'name' => 'Apple Macbook Pro',
                    'price' => 30000000,
                ],
                [
                    'name' => 'Samsung Galaxy S',
                    'price' => 15000000,
                ]
            ]
        ])
        ->assertSeeText('Apple Macbook Pro')
        ->assertSeeText('Samsung Galaxy S');
    }

    public function testQueryString(){
        $this->get('/input/query/string?name=budi')
        ->assertSeeText('budi');
    }

    public function testQueryStringArray(){
        $this->get('/input/query/string/array?name=budi&city=bekasi&country=indonesia')
        ->assertSeeText('budi')
        ->assertSeeText('bekasi')
        ->assertSeeText('indonesia');
    }

    public function testInputType(){
        $this->post('/input/type',[
            'name' => 'budi',
            'married' => 'true',
            'birth_date' => '2020-06-09'
        ])->assertSeeText('budi')->assertSeeText('true')->assertSeeText('2020-06-09');
    }

    public function testInputOnly(){
        $this->post('/input/filter/only',[
            'name' => [
                'first' => 'iqbal',
                'midddle' => 'maulana',
                'last' => 'menggala'
            ]
        ])->assertSeeText('iqbal')->assertSeeText('menggala')->assertDontSeeText('maulana');
    }

    public function testInputExcept(){
        $this->post('/input/filter/except',[
            'username' => 'iqbal',
            'password' => 'rahasia',
            'admin' => 'true',
        ])->assertSeeText('iqbal')->assertSeeText('rahasia')->assertDontSeeText('admin');
    }

    public function testInputMerge(){
        $this->post('/input/filter/merge',[
            'username' => 'iqbal',
            'password' => 'rahasia',
            'admin' => 'true',
        ])->assertSeeText('iqbal')->assertSeeText('rahasia')->assertSeeText('admin')->assertSeeText('false')->assertDontSeeText('true');
    }
}
