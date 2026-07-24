<?php

$src = imagecreatefrompng(__DIR__ . '/../public/images/logo.png');
$w = imagesx($src);
$h = imagesy($src);

$size = min($h, (int) ($w * 0.35));

$icon = imagecreatetruecolor($size, $size);
imagealphablending($icon, false);
imagesavealpha($icon, true);
$transparent = imagecolorallocatealpha($icon, 0, 0, 0, 127);
imagefill($icon, 0, 0, $transparent);
imagecopyresampled($icon, $src, 0, 0, 0, 0, $size, $size, $size, $size);

$public = __DIR__ . '/../public';

foreach ([16, 32, 180] as $s) {
    $out = imagecreatetruecolor($s, $s);
    imagealphablending($out, false);
    imagesavealpha($out, true);
    imagefill($out, 0, 0, $transparent);
    imagecopyresampled($out, $icon, 0, 0, 0, 0, $s, $s, $size, $size);

    $file = $s === 180
        ? $public . '/apple-touch-icon.png'
        : $public . "/favicon-{$s}.png";

    imagepng($out, $file);
    imagedestroy($out);
    echo "Created {$file}\n";
}

copy($public . '/favicon-32.png', $public . '/favicon.png');

// Simple ICO wrapper: copy 32px PNG as favicon.ico fallback (browsers accept PNG-in-ico path via link tags)
copy($public . '/favicon-32.png', $public . '/favicon.ico');

imagedestroy($icon);
imagedestroy($src);

echo "Done.\n";
