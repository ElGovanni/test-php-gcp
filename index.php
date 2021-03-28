<?php

require \dirname(__DIR__).'/test/vendor/autoload.php';

use Imagine\Image\Box;
use Imagine\Image\ImageInterface;


$imagine = new Imagine\Gd\Imagine();

$type = 'webp';
$image = $imagine
    ->open('img');

$image
    ->resize(new Box(500, 500))
    ->save("new-img-500.${type}")
;

$image->resize(new Box(250, 250))
    ->save("new-img-250.${type}")
;