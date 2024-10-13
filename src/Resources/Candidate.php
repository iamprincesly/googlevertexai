<?php

namespace Iamprincesly\GoogleVertexAI\Resources;

use Iamprincesly\GoogleVertexAI\Enums\Role;
use Iamprincesly\GoogleVertexAI\Resources\Content;
use Iamprincesly\GoogleVertexAI\Resources\Parts\TextPart;

final class Candidate
{
    public readonly Content $content;

    public readonly string $finishReason;

    public readonly array $safetyRatings;

    public readonly float $avgLogprobs;

    public function __construct(array $data)
    {
        $parts = array_map(function (array $part) {

            if (isset($part['text'])) { 
                return new TextPart($part['text']);
            }

        }, $data['content']['parts']);


        $this->content = new Content($parts, Role::cast($data['content']['role']));

        $this->finishReason = $data['finishReason'];

        $this->safetyRatings = array_map(fn($rating) => (object) $rating, $data['safetyRatings']);

        $this->avgLogprobs = $data['avgLogprobs'];
    }
}