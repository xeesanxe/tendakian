<?php
$dir = __DIR__ . '/../storage/app/public/products';
if (!is_dir($dir)) { echo "No dir\n"; exit; }
$files = scandir($dir);
foreach ($files as $f) {
    if ($f === '.' || $f === '..') continue;
    echo $f . PHP_EOL;
}
