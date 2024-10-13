<?php

namespace Iamprincesly\GoogleVertexAI\Facades;

use Illuminate\Support\Facades\Facade;

class VertexAI extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'vertexai';
    }
}
