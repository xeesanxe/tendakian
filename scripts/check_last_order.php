<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use App\Models\Order;
$o = Order::orderBy('id','desc')->first();
if (!$o) { echo "NO_ORDER"; exit; }
echo json_encode($o->toArray());
