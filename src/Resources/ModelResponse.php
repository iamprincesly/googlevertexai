<?php

namespace Iamprincesly\GoogleVertexAI\Resources;
use Iamprincesly\GoogleVertexAI\Contracts\PartContract;
use Iamprincesly\GoogleVertexAI\Resources\Parts\TextPart;

final class ModelResponse
{
    public readonly array $candidates;
    public readonly object $usageMetadata;
    public readonly string $model;

    public function __construct(array $data)
    {
        $this->candidates = array_map(fn (array $candidate) => new Candidate($candidate), $data['candidates']);

        $this->usageMetadata = (object) $data['usageMetadata'];

        $this->model = $data['modelVersion'];
    }

    public function answer(): string
    {
        return collect($this->candidates[0]->content->parts)
                ->filter(fn (PartContract $part) => $part instanceof TextPart)
                ->first()->text;
    }
}
