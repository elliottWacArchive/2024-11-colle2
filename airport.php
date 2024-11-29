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

if (strlen($str) < 31) {
    add_space($str);
}

global $color;

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

function add_space(&$str)
{
    $strlen = strlen($str);
    for ($i = 0; $i < (31 - $strlen); $i++) {
        $str = $str . " ";
    }
}

function defilement($str, $color)
{
    $strlen = strlen($str);
    for ($i = 0; $i < $strlen; $i++) {
        $newstr = cut_str($str);
        echo "\033[" . $color . "m$newstr\n";
        usleep(500000);
        @system('clear');
        $chr = substr($str, 0, 1);
        $str = substr($str, 1, $strlen);
        $str = $str . $chr;
    }
}

function cut_str($str)
{
    $strlen = strlen($str);
    $newstr = "";
    if ($strlen > 30) {
        for ($i = 0; $i != 30; $i++) {
            $newstr = $newstr . $str[$i];
        }
    }
    return $newstr;
}

while (true) {
    defilement($str, $color);
}
