<?php

namespace Iamprincesly\GoogleVertexAI;

use Iamprincesly\GoogleVertexAI\Enums\Role;
use Iamprincesly\GoogleVertexAI\Enums\Model;
use Iamprincesly\GoogleVertexAI\Enums\MimeType;
use Iamprincesly\GoogleVertexAI\Resources\Content;
use Iamprincesly\GoogleVertexAI\Settings\SafetySetting;
use Iamprincesly\GoogleVertexAI\Resources\ModelResponse;
use Iamprincesly\GoogleVertexAI\Resources\Parts\TextPart;
use Iamprincesly\GoogleVertexAI\Settings\GenerationConfig;
use Iamprincesly\GoogleVertexAI\Traits\ArrayTypeValidator;
use Iamprincesly\GoogleVertexAI\Resources\SystemInstruction;

class GoogleVertexAI
{
    use ArrayTypeValidator;
    
    protected GoogleVertexAIClient $client;
    protected Model $model;
    protected array $chatHistory = [];
    protected Content $content;
    public array $safetySettings = [];
    public ?GenerationConfig $generationConfig = null;
    public array $systemIntructions = [];

    public function __construct(?Model $model = null)
    {
        $this->model = $model ?? Model::cast(config('googlevertexai.model'));
        $this->client = new GoogleVertexAIClient();
        $this->content = new Content([], Role::User);
    }

    public function addSystemIntruction(string|TextPart $instruction): self
    {
        if (is_string($instruction)) { 
            $instruction = new TextPart($instruction);
        }

        $this->systemIntructions[] = $instruction;

        return $this;
    }

    public function setModel(Model $model): self
    {
        $this->model = $model;
        return $this;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function text(string $text): self
    {
        $this->content->addText($text);
        return $this;
    }

    public function video(string $uri, MimeType $mimeType = MimeType::VIDEO): self
    {
        $this->content->addFile($mimeType, $uri);
        return $this;
    }

    public function image(string $uri, MimeType $mimeType = MimeType::IMAGE): self
    {
        $this->content->addFile($mimeType, $uri);
        return $this;
    }

    public function file(string $uri, MimeType $mimeType): self
    {
        $this->content->addFile($mimeType, $uri);
        return $this;
    }

    public function inlineData(string $data, MimeType $mimeType): self
    {
        $this->content->addInlineData($mimeType, $data);
        return $this;
    }

    public function setRole(Role $role): self
    {
        $this->content->setRole($role);
        return $this;
    }

    public function withChatHistory(array $history): self
    {
        $this->ensureArrayOfType($history, Content::class);
        $this->chatHistory[] = $history;
        return $this;
    }

    public function addSafetySetting(SafetySetting $safetySetting): self
    {
        $this->safetySettings[] = $safetySetting;
        return $this;
    }

    public function setGenerationConfig(GenerationConfig $generationConfig): self
    {
        $this->generationConfig = $generationConfig;
        return $this;
    }

    public function send(): ModelResponse
    {
        $request = new GenerativeModelRequest($this->model, [...$this->chatHistory, $this->content]);

        if (!empty($this->systemIntructions)) {
            $request->setSystemIntruction(new SystemInstruction($this->systemIntructions));
        }

        foreach ($this->safetySettings as $safetySetting) {
            $request->setSafetySetting($safetySetting);
        }

        if (!is_null($this->generationConfig)) {
            $request->setGenerationConfig($this->generationConfig);
        }

        return $this->client->sendRequest($request->getOperation(), $request->getHttpPayload());
    }
}
