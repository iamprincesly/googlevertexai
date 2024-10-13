<?php

declare(strict_types=1);

namespace Iamprincesly\GoogleVertexAI\Settings;

use JsonSerializable;
use Iamprincesly\GoogleVertexAI\Enums\HarmCategory;
use Iamprincesly\GoogleVertexAI\Enums\HarmBlockThreshold;

class SafetySetting implements JsonSerializable
{
    public function __construct(
        public readonly HarmCategory $category,
        public readonly HarmBlockThreshold $threshold,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'category' => $this->category->value,
            'threshold' => $this->threshold->value,
        ];
    }

    public function __toString()      
    {
        return json_encode($this) ?: '';
    }
}
