<?php

declare(strict_types=1);

$input = file_get_contents(__DIR__ . '/input');
$input = explode(PHP_EOL, $input);

$depthCounter = 0;
$last = (int)$input[0];
foreach ($input as $val) {
    if ((int)$val > $last) {
        $depthCounter++;
    }

    $last = (int)$val;
}

echo('Part 1: ' . $depthCounter . PHP_EOL);

$depthCounter = 0;
$lastWindow = (int)$input[0] + (int)$input[1] + (int)$input[2];
for ($i = 0; $i <= count($input) - 3; $i++) {
    $window = (int)$input[$i] + (int)$input[$i + 1] + (int)$input[$i + 2];

    if ($window > $lastWindow) {
        $depthCounter++;
    }

    $lastWindow = $window;
}

echo('Part 2: ' . $depthCounter . PHP_EOL);