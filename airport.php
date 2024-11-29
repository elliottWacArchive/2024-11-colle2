<?php

@system('clear');

if ($argc < 2) {
    echo "veuillez entrer un paramètre.";
    exit();
}

$str = $argv[1];
if (!is_string($str)) {
    echo "veuillez entrer un paramètre valide.";
    exit();
}

global $color;
global $size;
$size = 31;

if ($argc > 3) {
    $size = intval($argv[3]);
}

if (strlen($str) < $size + 1) {
    add_space($str, $size);
}

if ($argc > 2) {
    switch ($argv[2]) {
        case "red":
            $color = 31;
            break;
        case "green":
            $color = 32;
            break;
        case "blue":
            $color = 34;
            break;
        case "yellow":
            $color = 33;
            break;
        case "magenta":
            $color = 35;
            break;
        default:
            $color = 37;
    }
}

function add_space(&$str, $size)
{
    $strlen = strlen($str);
    for ($i = 0; $i < (($size + 1) - $strlen); $i++) {
        $str = $str . " ";
    }
}

function defilement($str, $color, $size)
{
    $strlen = strlen($str);
    for ($i = 0; $i < $strlen; $i++) {
        $newstr = cut_str($str, $size);
        echo "\033[" . $color . "m$newstr\n";
        usleep(500000);
        @system('clear');
        $chr = substr($str, 0, 1);
        $str = substr($str, 1, $strlen);
        $str = $str . $chr;
    }
}

function cut_str($str, $size)
{
    $strlen = strlen($str);
    $newstr = "";
    if ($strlen > $size) {
        for ($i = 0; $i != $size; $i++) {
            $newstr = $newstr . $str[$i];
        }
    }
    return $newstr;
}

while (true) {
    defilement($str, $color, $size);
}
