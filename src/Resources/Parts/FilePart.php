<?php

declare(strict_types=1);

namespace Iamprincesly\GoogleVertexAI\Resources\Parts;

use JsonSerializable;

use Iamprincesly\GoogleVertexAI\Enums\MimeType;
use Iamprincesly\GoogleVertexAI\Contracts\PartContract;

class FilePart implements PartContract, JsonSerializable
{
    public function __construct(
        public readonly MimeType $mimeType,
        public readonly string $fileUri,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'fileData' => [
                'mimeType' => $this->mimeType->value,
                'fileUri' => $this->fileUri,
            ]
        ];
    }

    public function __toString(): string
    {
        return json_encode($this) ?: '';
    }
}
