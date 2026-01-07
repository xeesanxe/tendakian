$dir = Join-Path $PSScriptRoot '..\\storage\\app\\public\\products'
New-Item -ItemType Directory -Force -Path $dir | Out-Null
$images = @{
    'tent.jpg' = 'https://picsum.photos/seed/tent/900/600'
    'backpack.jpg' = 'https://picsum.photos/seed/backpack/900/600'
    'stove.jpg' = 'https://picsum.photos/seed/stove/900/600'
    'sleepingbag.jpg' = 'https://picsum.photos/seed/sleepingbag/900/600'
    'boots.jpg' = 'https://picsum.photos/seed/boots/900/600'
    'lantern.jpg' = 'https://picsum.photos/seed/lantern/900/600'
}
foreach ($name in $images.Keys) {
    $url = $images[$name]
    $out = Join-Path $dir $name
    try {
        Invoke-WebRequest -Uri $url -OutFile $out -UseBasicParsing -ErrorAction Stop
        Write-Host "DL OK: $name"
    } catch {
        Write-Host "DL ERR: $name - $($_.Exception.Message)"
    }
}
Write-Host "Done."
