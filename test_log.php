<?php

use App\Models\ApiLog;

require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Attempting to create ApiLog with null request_id...\n";
    ApiLog::create([
        'request_id' => null, 
        'uri' => 'test', 
        'method' => 'GET', 
        'status_code' => 200, 
        'duration' => 100, 
        'request' => [], 
        'response' => [], 
        'user_id' => 1
    ]);
    echo "Success!\n";
} catch (\Exception $e) {
    echo "Failed: " . $e->getMessage() . "\n";
}
