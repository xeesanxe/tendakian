<?php
$urls = [
    'http://127.0.0.1:8000/storage/products/tent.jpg',
    'http://127.0.0.1:8000/shop',
];
foreach ($urls as $u) {
    echo "Checking $u ... ";
    $ctx = stream_context_create(['http'=>['timeout'=>5]]);
    $c = @file_get_contents($u,false,$ctx);
    echo ($c !== false) ? "OK\n" : "FAILED\n";
}
