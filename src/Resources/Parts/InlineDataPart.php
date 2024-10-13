<?php

declare(strict_types=1);

namespace Iamprincesly\GoogleVertexAI\Resources\Parts;

use JsonSerializable;

use Iamprincesly\GoogleVertexAI\Enums\MimeType;
use Iamprincesly\GoogleVertexAI\Contracts\PartContract;

class InlineDataPart implements PartContract, JsonSerializable
{
    public function __construct(
        public readonly MimeType $mimeType,
        public readonly string $data,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'inlineData' => [
                'mimeType' => $this->mimeType->value,
                'data' => $this->data,
            ],
        ];
    }

    public function __toString(): string
    {
        return json_encode($this) ?: '';
    }
}
