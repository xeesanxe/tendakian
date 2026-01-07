<?php
$dir = __DIR__ . '/../storage/app/public/products';
@mkdir($dir, 0777, true);
$images = [
    'tent.jpg' => 'https://source.unsplash.com/900x600/?tent',
    'backpack.jpg' => 'https://source.unsplash.com/900x600/?backpack',
    'stove.jpg' => 'https://source.unsplash.com/900x600/?camping-stove,stove',
    'sleepingbag.jpg' => 'https://source.unsplash.com/900x600/?sleeping-bag',
    'boots.jpg' => 'https://source.unsplash.com/900x600/?hiking-boots,boots',
    'lantern.jpg' => 'https://source.unsplash.com/900x600/?lantern,light',
];
foreach ($images as $name => $url) {
    $path = $dir . '/' . $name;
    echo "Downloading $name... ";
    try {
        $data = @file_get_contents($url);
        if ($data === false) {
            echo "FAILED\n";
            continue;
        }
        file_put_contents($path, $data);
        echo "OK\n";
    } catch (Exception $e) {
        echo "ERR: " . $e->getMessage() . "\n";
    }
}
echo "Done.\n";
