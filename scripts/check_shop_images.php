<?php
// Fetch the shop page and report any /storage/products/ image references
$url = 'http://127.0.0.1:8000/shop';
echo "Fetching: $url\n";
$html = @file_get_contents($url);
if ($html === false) {
    echo "Failed to fetch shop page. Is the dev server running?\n";
    exit(1);
}
preg_match_all('/(\/storage\/products\/[^"\'\s>]+)/', $html, $m);
$found = $m[1] ?? [];
if (empty($found)) {
    echo "No storage/product image links found in shop HTML.\n";
} else {
    echo "Found storage images in shop HTML:\n";
    foreach (array_unique($found) as $f) {
        echo " - $f\n";
    }
}
// Also check for external placeholders
preg_match_all('/https?:\/\/source\.unsplash\.com[^"\'\s>]+|https?:\/\/picsum\.photos[^"\'\s>]+/', $html, $ext);
if (!empty($ext[0])) {
    echo "Found external placeholder images (examples):\n";
    foreach (array_unique(array_slice($ext[0],0,5)) as $e) echo " - $e\n";
}

exit(0);
