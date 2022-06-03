<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    public function testConfig(){
        $firstName = config('contoh.author.first');
        $lastName = config('contoh.author.last');
        $email = config('contoh.email');
        $web = config('contoh.web');

        self::assertEquals('Iqbal',$firstName);
        self::assertEquals('Menggala',$lastName);
        self::assertEquals('iqbalmenggala29@gmail.com',$email);
        self::assertEquals('iqbal.com',$web);
    }
}
