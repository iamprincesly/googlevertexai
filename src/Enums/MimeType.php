<?php

declare(strict_types=1);

namespace Iamprincesly\GoogleVertexAI\Enums;

enum MimeType: string
{
    case IMAGE_PNG = 'image/png';
    case IMAGE_JPEG = 'image/jpeg';
    case IMAGE_HEIC = 'image/heic';
    case IMAGE_HEIF = 'image/heif';
    case IMAGE_WEBP = 'image/webp';
    case IMAGE = 'image/*';
    case VIDEO_MP4 = 'video/mp4';
    case VIDEO_AVI = 'video/x-msvideo';
    case VIDEO_MKV = 'video/x-matroska';
    case VIDEO = 'video/*';

}
