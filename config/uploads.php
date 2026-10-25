<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Upload limits
    |--------------------------------------------------------------------------
    |
    | Sizes are in kilobytes. Override them with UPLOAD_IMAGE_MAX_KB,
    | UPLOAD_ATTACHMENT_MAX_KB and UPLOAD_ATTACHMENT_MAX_COUNT.
    | PHP upload_max_filesize and post_max_size must be at least as large.
    |
    */

    'image_max_kb' => (int) env('UPLOAD_IMAGE_MAX_KB', 5120),

    'attachment_max_kb' => (int) env('UPLOAD_ATTACHMENT_MAX_KB', 10240),

    'attachment_max_count' => (int) env('UPLOAD_ATTACHMENT_MAX_COUNT', 10),

];
