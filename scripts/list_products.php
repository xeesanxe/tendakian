<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$status = $kernel->handle(
    $input = new Symfony\Component\Console\Input\ArgvInput,
    new Symfony\Component\Console\Output\NullOutput
);

use App\Models\Product;
$products = Product::all();
foreach($products as $p){
    echo $p->id . ' => ' . ($p->image ?: '(no image)') . PHP_EOL;
}
$kernel->terminate($input, $status);
