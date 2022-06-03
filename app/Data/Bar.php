<?php

namespace App\Data;
use App\Data\Foo;

class Bar {
     public Foo $foo;

     public function __construct(Foo $foo)
     {
          $this->foo = $foo;
     }

     public function bar(): string {
          return $this->foo->foo() . " and Bar";
     }
}