<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testGetEnv()
    {
        $youtube = env('Developments');
        self::assertEquals('belajar-php-dasar', $youtube);
    }

    public function testDefaultEnv()
    {
        $author = env('AUTHOR', 'Iqbal');
        self::assertEquals('Iqbal', $author);
    }
}
