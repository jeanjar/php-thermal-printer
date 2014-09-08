<?php

include '../init.php';
/**
 * $path = '/dev/usb/lp0'; <- it's a printer
 */
$path = 'notAPrinter';

$printer = new Printer_Thermal($path);

$printer->printCenteredString('Pedido Número #231');
$printer->printRule();
$printer->printString('1x Calabresa Goumert');
$printer->printString('1x Calabresa Goumert');
$printer->printString('1x Calabresa Goumert');
$printer->printString('1x Calabresa Goumert');
$printer->printString('1x Calabresa Goumert');
$printer->printRule();
$printer->printCenteredString('Documento sem valor fiscal');

$printer->closePrinter();

$file = file_get_contents($path);
$file = str_replace(["\n", "\t"], ['<br/>', '&nbsp;'], $file);

header('Content-type: text/html; charset=UTF-8');
echo $file;
die;
