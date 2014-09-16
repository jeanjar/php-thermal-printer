<?php

/**
 * @author Jean Jar <jeanjpa@gmail.com>
 * @package Printer
 */
class Printer_Web extends Printer_Thermal
{

    const NEWLINE = "</br>";
    const TRAIL_SPACE = "&#09;";

    public function __construct($path, $mode = 'w')
    {
        parent::__construct($path, $mode);
        fwrite($this->handle, '<div style="font-family:' . Printer_Config::$webLayoutFontFamily . ';width:' . Printer_Config::$webLayoutWith . ';">');
    }

    public function printCenteredString($string, $newline = TRUE)
    {
        fwrite($this->handle, '<center>' . $string . '</center>');
        $this->printNewline($newline);
    }

    public function closePrinter()
    {
        fwrite($this->handle, '</div>');
        parent::closePrinter();
    }

}
