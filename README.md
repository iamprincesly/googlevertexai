# Google Vertex AI for Laravel
Laravel wrapper for Google Vertex AI with Gemini models

Usage is simple

```php
use Iamprincesly\GoogleVertexAI\Facades\VertexAI;

$ai = VertexAI::text('Who is the current president of Nigeria?');
dd($ai->answer())
```

Add Video and Image from url

```php
use Iamprincesly\GoogleVertexAI\Facades\VertexAI;

$ai = VertexAI::text('Please watch the video and the image and explain what is all about?');
                ->video('url-any-video-or-youtube')
                ->image('url-to-any-image')

dd($ai->answer())
```

With chat history

```php
use Iamprincesly\GoogleVertexAI\Enums\Role;
use Iamprincesly\GoogleVertexAI\Facades\VertexAI;
use Iamprincesly\GoogleVertexAI\Resources\Content;

$history = [
    Content::text('what is the video all about', Role::User)
            ->file('https://www.youtube.com/watch?v=zintSf6A78g', MimeType::VIDEO_MP4)
            ->inlineData(base64_encode(file_get_contents('https://storage.googleapis.com/generativeai-downloads/images/scones.jpg')), MimeType::VIDEO_MP4),
    Content::text('The video is and file is all about PHP.' Role::Model),
];

$ai = VertexAI::text('Please watch the video and the image and explain what is all about?');
                ->video('url-any-video-or-youtube')
                ->image('url-to-any-image')
                ->withChatHistory($history)

dd($ai->answer())
```

With generation config

```php
use Iamprincesly\GoogleVertexAI\Facades\VertexAI;
use Iamprincesly\GoogleVertexAI\Settings\GenerationConfig;

$generationConfig = (new GenerationConfig())
                    ->withCandidateCount(1)
                    ->withMaxOutputTokens(40)
                    ->withTemperature(0.5)
                    ->withTopK(40)
                    ->withTopP(0.6)
                    ->withStopSequences(['STOP']);

$ai = VertexAI::text('Please watch the video and the image and explain what is all about?');
                ->video('url-any-video-or-youtube')
                ->image('url-to-any-image')
                ->setGenerationConfig($generationConfig)

dd($ai->answer())
```

With safety settings

```php
use Iamprincesly\GoogleVertexAI\Facades\VertexAI;
use Iamprincesly\GoogleVertexAI\Enums\HarmCategory;
use Iamprincesly\GoogleVertexAI\Settings\SafetySetting;
use Iamprincesly\GoogleVertexAI\Enums\HarmBlockThreshold;

$ai = VertexAI::text('Please watch the video and the image and explain what is all about?');
                ->video('url-any-video-or-youtube')
                ->image('url-to-any-image')
                ->addSafetySetting(new SafetySetting(HarmCategory::HARM_CATEGORY_UNSPECIFIED, HarmBlockThreshold::HARM_BLOCK_THRESHOLD_UNSPECIFIED))
                ->addSafetySetting(new SafetySetting(HarmCategory::HARM_CATEGORY_HARASSMENT, HarmBlockThreshold::BLOCK_MEDIUM_AND_ABOVE))

dd($ai->answer())
```