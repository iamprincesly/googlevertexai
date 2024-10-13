<?php

declare(strict_types=1);

namespace Iamprincesly\GoogleVertexAI\Resources;

use JsonSerializable;
use Iamprincesly\GoogleVertexAI\Enums\Role;
use Iamprincesly\GoogleVertexAI\Contracts\PartContract;
use Iamprincesly\GoogleVertexAI\Resources\Parts\TextPart;
use Iamprincesly\GoogleVertexAI\Traits\ArrayTypeValidator;

class SystemInstruction implements JsonSerializable
{
    use ArrayTypeValidator;

    /**
     * @param PartContract[] $parts
     * @param Role $role
     */
    public function __construct(
        public array $parts,
        public readonly Role $role = Role::User,
    ) {
        $this->ensureArrayOfType($parts, PartContract::class);
    }

    public function addText(string $text): self
    {
        $this->parts[] = new TextPart($text);
        return $this;
    }

    public static function text(string $text, Role $role = Role::User): self 
    {
        return new self([new TextPart($text)], $role);
    }

    public function jsonSerialize(): array
    {
        return  [
            'role' => $this->role ,
            'parts' => $this->parts
        ];
    }

    public function __toString(): string
    {
        return json_encode($this) ?: '';
    }
}
