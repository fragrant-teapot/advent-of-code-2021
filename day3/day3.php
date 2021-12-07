<?php

declare(strict_types=1);

const TEST_INPUT = [
    '00100',
    '11110',
    '10110',
    '10111',
    '10101',
    '01111',
    '00111',
    '11100',
    '10000',
    '11001',
    '00010',
    '01010'
];

printf('Part 1' . PHP_EOL);

$input = file_get_contents(__DIR__ . '/input');
$input = explode(PHP_EOL, $input);
$input = buildInputArray($input);

$gammaRate = '';
$epsilonRate = '';

for ($i = 0; $i < count($input[0]); $i++) {
    $mostCommonBit = calculateMostCommonBitAtPosition($input, $i);
    $gammaRate .= $mostCommonBit;
    $epsilonRate .= abs($mostCommonBit - 1);
}

printf('Gamma Rate: %d' . PHP_EOL . 'Epsilon Rate: %d' . PHP_EOL, $gammaRate, $epsilonRate);


$gammaRate = bindec($gammaRate);
$epsilonRate = bindec($epsilonRate);

printf('Gamma Rate: %d' . PHP_EOL . 'Epsilon Rate: %d' . PHP_EOL, $gammaRate, $epsilonRate);
printf('Power Consumption: %d' . PHP_EOL, $gammaRate * $epsilonRate);

printf('Part 2' . PHP_EOL);

$oxygenRating = calculateOxygenRating($input);
$co2Rating = calculateCO2ScrubberRating($input);

printf('Oxygen Rating: %d' . PHP_EOL . 'CO2 Rating: %d' . PHP_EOL, $oxygenRating, $co2Rating);

$oxygenRating = bindec($oxygenRating);
$co2Rating = bindec($co2Rating);

printf('Oxygen Rating: %d' . PHP_EOL . 'CO2 Rating: %d' . PHP_EOL, $oxygenRating, $co2Rating);
printf('Life Support Rating: %d' . PHP_EOL, $oxygenRating * $co2Rating);

function buildInputArray($rawInput): array
{
    $ret = [];

    foreach ($rawInput as $row) {
        $ret[] = str_split($row);
    }

    return $ret;
}

function calculateMostCommonBitAtPosition(array $input, int $position): int
{
    $count = count($input);
    $sum = 0;

    for ($i = 0; $i < $count; $i++) {
        $sum = $sum + (int)$input[$i][$position];
    }

    if ($sum >= $count / 2) {
        return 1;
    }
    return 0;
}

function filterInputRowsByBitvalueAtPosition(array $input, int $position, int $bitvalue): array
{
    $ret = [];

    foreach ($input as $row) {
        if ((int)$row[$position] === $bitvalue) {
            $ret[] = $row;
        }
    }

    return $ret;
}

function calculateOxygenRating(array $input): string
{
    $position = 0;

    while (count($input) > 1) {
        $bit = calculateMostCommonBitAtPosition($input, $position);
        $input = filterInputRowsByBitvalueAtPosition($input, $position, $bit);
        $position++;
    }

    return implode('', current($input));
}

function calculateCO2ScrubberRating(array $input): string
{
    $position = 0;

    while (count($input) > 1) {
        $bit = abs(calculateMostCommonBitAtPosition($input, $position) - 1);
        $input = filterInputRowsByBitvalueAtPosition($input, $position, $bit);
        $position++;
    }

    return implode('', current($input));
}