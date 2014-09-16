<?php

include '../boot.php';

$path = '/dev/usb/lp0'; //use this path to real print

$path = 'thermalPrintTest';

$printer = new Printer_Thermal($path);

$printer->printCenteredString('Pedido Número #231');
$printer->printRule();
$printer->printString('1x Calabresa Goumert');
$printer->printString('1x Calabresa Goumert');
$printer->printString('1x Calabresa Goumert');
$printer->printString('1x Calabresa Goumert');
$printer->printString('1x Calabresa Goumert');
$printer->printCartItem('1x Calabresa Goumert ', ' R$19,90', '-');
$printer->printRule();
$printer->printCenteredString('Documento sem valor fiscal');

$printer->closePrinter();