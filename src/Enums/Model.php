<?php

declare(strict_types=1);

namespace Iamprincesly\GoogleVertexAI\Enums;

use Iamprincesly\GoogleVertexAI\Traits\BaseEnum;

enum Model: string
{
    use BaseEnum;
    
    case Default = 'text-bison-001';
    case GeminiPro = 'gemini-pro';
    case Gemini10Pro = 'gemini-1.0-pro';
    case Gemini10ProLatest = 'gemini-1.0-pro-latest';
    case Gemini15Pro = 'gemini-1.5-pro';
    case Gemini15Pro001 = 'gemini-1.5-pro-001';
    case Gemini15Pro002 = 'gemini-1.5-pro-002';
    case Gemini15ProLatest = 'gemini-1.5-pro-latest';
    case Gemini15Flash = 'gemini-1.5-flash';
    case Gemini15Flash001 = 'gemini-1.5-flash-001';
    case Gemini15Flash002 = 'gemini-1.5-flash-002';
    case Gemini15FlashLatest = 'gemini-1.5-flash-latest';
    case GeminiProVision = 'gemini-pro-vision';
    case Embedding = 'embedding-001';
    case AQA = 'aqa';
}
