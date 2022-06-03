<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class FacadeTest extends TestCase
{
    public function testFacade(){
        $firstName1 = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        assertEquals($firstName1,$firstName2);
        var_dump(Config::all());
    }

    public function testConfigDependency(){
        $config = $this->app->make('config');
        $firstName3 = $config->get('contoh.author.first');

        $firstName1 = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        assertEquals($firstName1,$firstName3);
        assertEquals($firstName2,$firstName3);

        var_dump($config->all());
    }

    public function testFacadeMock(){
        Config::shouldReceive('get')
        ->with('contoh.author.first')
        ->andReturn('Iqbal Menggala');

        $firstName = Config::get('contoh.author.first');

        assertEquals('Iqbal Menggala',$firstName);
    }

    public function testFallback(){
        $this->get('tidakada')
        ->assertSeeText('404 by Iqbal Menggala');

        $this->get('tidakadalagi')
        ->assertSeeText('404 by Iqbal Menggala');

        $this->get('ups')
        ->assertSeeText('404 by Iqbal Menggala');
    }
}
