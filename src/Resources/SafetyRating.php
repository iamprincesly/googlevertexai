<?php

namespace Iamprincesly\GoogleVertexAI\Resources;

class SafetyRating
{
    public string $category;
    public string $probability;
    public float $probabilityScore;
    public string $severity;
    public float $severityScore;

    public function __construct(array $data)
    {
        $this->category = $data['category'];
        $this->probability = $data['probability'];
        $this->probabilityScore = $data['probabilityScore'];
        $this->severity = $data['severity'];
        $this->severityScore = $data['severityScore'];

        $rr = [
            "candidates" => [
                [
                    "content" => [
                        "role" => "model",
                        "parts" => [
                            [
                                "text" => "Lekki is a suburb of **Lagos, Nigeria**"
                            ]
                        ]
                    ],
                    "finishReason" => "STOP",
                    "safetyRatings" => [
                        [
                            "category" => "HARM_CATEGORY_HATE_SPEECH",
                            "probability" => "NEGLIGIBLE",
                            "probabilityScore" => 0.055908203,
                            "severity" => "HARM_SEVERITY_NEGLIGIBLE",
                            "severityScore" => 0.05493164,
                        ],
                        [
                            "category" => "HARM_CATEGORY_DANGEROUS_CONTENT",
                            "probability" => "NEGLIGIBLE",
                            "probabilityScore" => 0.17578125,
                            "severity" => "HARM_SEVERITY_NEGLIGIBLE",
                            "severityScore" => 0.052734375,
                        ],
                        [
                            "category" => "HARM_CATEGORY_HARASSMENT",
                            "probability" => "NEGLIGIBLE",
                            "probabilityScore" => 0.099609375,
                            "severity" => "HARM_SEVERITY_NEGLIGIBLE",
                            "severityScore" => 0.028442383,
                        ],
                        [
                            "category" => "HARM_CATEGORY_SEXUALLY_EXPLICIT",
                            "probability" => "NEGLIGIBLE",
                            "probabilityScore" => 0.18457031,
                            "severity" => "HARM_SEVERITY_NEGLIGIBLE",
                            "severityScore" => 0.10107422,
                        ],
                    ],
                    "avgLogprobs" => -0.3296746412913,
                ],
            ],
            "usageMetadata" => [
                "promptTokenCount" => 5,
                "candidatesTokenCount" => 48,
                "totalTokenCount" => 53,
            ],
            "modelVersion" => "gemini-1.5-flash-001",
        ];
    }

}