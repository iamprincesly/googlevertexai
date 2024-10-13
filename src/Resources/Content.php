<?php

declare(strict_types=1);

namespace Iamprincesly\GoogleVertexAI\Resources;

use JsonSerializable;
use Iamprincesly\GoogleVertexAI\Enums\Role;
use Iamprincesly\GoogleVertexAI\Enums\MimeType;
use Iamprincesly\GoogleVertexAI\Contracts\PartContract;
use Iamprincesly\GoogleVertexAI\Resources\Parts\FilePart;
use Iamprincesly\GoogleVertexAI\Resources\Parts\TextPart;
use Iamprincesly\GoogleVertexAI\Traits\ArrayTypeValidator;
use Iamprincesly\GoogleVertexAI\Resources\Parts\InlineDataPart;

class Content implements JsonSerializable
{
    use ArrayTypeValidator;

    /**
     * @param PartContract[] $parts
     * @param Role $role
     */
    public function __construct(
        public array $parts,
        public readonly Role $role,
    ) {
        $this->ensureArrayOfType($parts, PartContract::class);
    }

    public function setRole(Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function addText(string $text): self
    {
        $this->parts[] = new TextPart($text);

        return $this;
    }

    public function addFile(MimeType $mimeType, string $fileUri): self
    {
        $this->parts[] = new FilePart($mimeType, $fileUri);

        return $this;
    }

    public function addInlineData(MimeType $mimeType, string $data): self
    {
        $this->parts[] = new InlineDataPart($mimeType, $data);

        return $this;
    }

    public static function text(string $text, Role $role = Role::User): self 
    {
        return new self([new TextPart($text)], $role);
    }

    public static function file(MimeType $mimeType, string $fileUri, Role $role = Role::User): self 
    {
        return new self([new FilePart($mimeType, $fileUri)], $role);
    }

    public static function inlineData(MimeType $mimeType, string $data, Role $role = Role::User): self 
    {
        return new self([new InlineDataPart($mimeType, $data)], $role);
    }

    public function jsonSerialize(): array
    {
        return [
            'role' => $this->role->value,
            'parts' =>  $this->parts,
        ];
    }

    public function __toString(): string
    {
        return json_encode($this) ?: '';
    }
}
