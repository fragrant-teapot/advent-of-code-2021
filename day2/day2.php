<?php

declare(strict_types=1);

$rawInput = file_get_contents(__DIR__ . '/input');
$rawInput = explode(PHP_EOL, $rawInput);

printf('Part 1' . PHP_EOL);

$horizontalPosition = 0;
$depth = 0;

foreach ($rawInput as $input) {
    $input = explode(' ', $input);
    match ($input[0]) {
        'forward' => $horizontalPosition = $horizontalPosition + (int)$input[1],
        'up' => $depth = $depth - (int)$input[1],
        'down' => $depth = $depth + (int)$input[1]
    };
}

printf(sprintf('Horizontal Position: %d, Depth: %d' . PHP_EOL, $horizontalPosition, $depth));
printf(sprintf('Horizontal Position * Depth = %d' . PHP_EOL, $horizontalPosition * $depth));

printf('Part 2' . PHP_EOL);

$horizontalPosition = 0;
$aim = 0;
$depth= 0;

foreach ($rawInput as $input) {
    $input = explode(' ', $input);
    switch ($input[0]) {
        case 'forward':
            $horizontalPosition = $horizontalPosition + (int)$input[1];
            $depth = $depth + ($aim * (int)$input[1]);
            break;
        case 'up':
            $aim = $aim - (int)$input[1];
            break;
        case 'down':
            $aim = $aim + (int)$input[1];
            break;
    };
}

printf(sprintf('Horizontal Position: %d, Depth: %d' . PHP_EOL, $horizontalPosition, $depth));
printf(sprintf('Horizontal Position * Depth = %d' . PHP_EOL, $horizontalPosition * $depth));