<?php

declare(strict_types=1);

namespace Iamprincesly\GoogleVertexAI\Resources\Parts;

use JsonSerializable;

use Iamprincesly\GoogleVertexAI\Contracts\PartContract;

class TextPart implements PartContract, JsonSerializable
{
    public function __construct(
        public readonly string $text
    ) {
    }

    public function jsonSerialize(): array
    {
        return ['text' => $this->text];
    }

    public function __toString(): string
    {
        return json_encode($this) ?: '';
    }
}
