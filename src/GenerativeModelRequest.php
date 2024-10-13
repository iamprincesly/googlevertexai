<?php

namespace Iamprincesly\GoogleVertexAI;

use JsonSerializable;
use Iamprincesly\GoogleVertexAI\Enums\Model;
use Iamprincesly\GoogleVertexAI\Resources\Content;
use Iamprincesly\GoogleVertexAI\Settings\SafetySetting;
use Iamprincesly\GoogleVertexAI\Settings\GenerationConfig;
use Iamprincesly\GoogleVertexAI\Traits\ArrayTypeValidator;
use Iamprincesly\GoogleVertexAI\Resources\SystemInstruction;

class GenerativeModelRequest implements JsonSerializable
{
    use ArrayTypeValidator;

    public function __construct(
        public Model $model,
        public $contents,
        public ?SystemInstruction $systemInstruction = null,
        public array $safetySettings = [],
        public ?GenerationConfig $generationConfig = null,
    ) {
        $this->ensureArrayOfType($this->contents, Content::class);
        $this->ensureArrayOfType($this->safetySettings, SafetySetting::class);
    }

    public function getOperation(): string
    {
        return "models/{$this->model->value}:generateContent";
    }

    public function setSystemIntruction(SystemInstruction $systemInstruction): self
    {
        $this->systemInstruction = $systemInstruction;
        return $this;
    }

    public function setSafetySetting(SafetySetting $SafetySetting): self
    {
        $this->safetySettings[] = $SafetySetting;
        return $this;
    }

    public function setGenerationConfig(GenerationConfig $generationConfig): self
    {
        $this->generationConfig = $generationConfig;
        return $this;
    }

    public function getHttpPayload()
    {
        return (string) $this;
    }

    public function jsonSerialize(): array
    {
        $arr = [
            'model' => $this->model->value,
            'contents' => array_unique($this->contents),
        ];

        if ($this->systemInstruction) {
            $arr['systemInstruction'] = $this->systemInstruction;
        }

        if (!empty($this->safetySettings)) {
            $arr['safetySettings'] = array_unique($this->safetySettings);
        }

        if ($this->generationConfig) {
            $arr['generationConfig'] = $this->generationConfig;
        }

        return $arr;
    }

    public function __toString(): string
    {
        return json_encode($this) ?: '';
    }
}
