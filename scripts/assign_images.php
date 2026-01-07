<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$status = $kernel->handle(
    $input = new Symfony\Component\Console\Input\ArgvInput,
    new Symfony\Component\Console\Output\NullOutput
);

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

$sample = ['products/tent.jpg','products/backpack.jpg','products/stove.jpg','products/sleepingbag.jpg','products/boots.jpg','products/lantern.jpg'];
$i = 0;
$updated = 0;
foreach(Product::whereNull('image')->orWhere('image','')->get() as $p){
    $p->image = $sample[$i % count($sample)];
    $p->save();
    $i++;
    $updated++;
}
echo "Assigned images to $updated products\n";

$kernel->terminate($input, $status);
