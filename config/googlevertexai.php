<?php

return [
    'project_id' => env('GOOGLE_VERTEX_AI_PROJECT_ID'),
    'api_version' => env('GOOGLE_VERTEX_AI_API_VERSION', 'v1'),
    'location' => env('GOOGLE_VERTEX_AI_LOCATION', 'us-central1'),
    'model' => env('GOOGLE_VERTEX_AI_MODEL', 'gemini-1.5-flash-latest'),
    'credentials_path' => env('GOOGLE_APPLICATION_CREDENTIALS', base_path('google-credentials.json')),
];