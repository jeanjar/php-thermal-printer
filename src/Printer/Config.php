<?php

/**
 * @author Jean Jar <jeanjpa@gmail.com>
 * @package Printer
 */

class Printer_Config
{

    public static $webLayoutFontFamily = 'monospace';
    public static $webLayoutWith = 256;
    public static $charsPerLine = 32;

    
    /**
     * Overwrite static atributes
     * @param array $args
     */
    public function init($args = [])
    {
        foreach ($args as $key => $value)
        {
            self::$$key = $value;
        }
    }

}
