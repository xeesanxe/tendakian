<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$p = App\Models\Product::first();
if (!$p) {
    echo "NO_PRODUCT";
    exit;
}
echo json_encode(['id' => $p->id, 'name' => $p->name, 'price' => $p->price]);
