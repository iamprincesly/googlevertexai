<?php

declare(strict_types=1);

namespace Iamprincesly\GoogleVertexAI\Enums;

use Iamprincesly\GoogleVertexAI\Traits\BaseEnum;

enum Role: string
{
    use BaseEnum;
    
    case User = 'user';
    case Model = 'model';
}
