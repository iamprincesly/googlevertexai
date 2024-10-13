<?php

namespace Iamprincesly\GoogleVertexAI\Resources;

class UsageMetadata
{
    public int $promptTokenCount;
    public int $candidatesTokenCount;
    public int $totalTokenCount;

    public function __construct(array $data)
    {
        $this->promptTokenCount = $data['promptTokenCount'];
        $this->candidatesTokenCount = $data['candidatesTokenCount'];
        $this->totalTokenCount = $data['totalTokenCount'];
    }
}