<?php
namespace App\Scopes;
use \App\Scopes\CurrentClientScope;

trait CurrentClient {


    public static function bootCurrentClient()
    {
        static::addGlobalScope(new CurrentClientScope);
    }

}
