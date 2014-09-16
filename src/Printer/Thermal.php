<?php

/**

 * @abstract A simple printing class for the POS58III - Line Thermal Printer
 * 
 * @author David Booth <github.com/davidbooth>
 * @date 8/18/2013
 * 
 * @author Jean Jar Pereira de Araújo <jeanjpa@gmail.com>   
 * @date 08/09/2014
 * 
 * @package Printer
 * 
 * @hint Permission problems try: chmod 666 /dev/usb/lp0
 */
class Printer_Thermal
{

    const NEWLINE = "\x0A";
    const TRAIL_SPACE = "\x1B\x4A\x9B";

    var $handle;

    /*
      Initialize printer
      =============================================================
      $path - Path to the printer ex. "/dev/usb/lp0"
     */

    public function __construct($path, $mode = 'w')
    {
        $this->handle = fopen($path, $mode);
    }

    /*
      Prints $string optionally followed by a newline
      =============================================================
      $string - String to print
      $newline - If TRUE the string will be followed by a newline
     */

    public function printString($string, $newline = TRUE)
    {

        fwrite($this->handle, $string);
        $this->printNewline($newline);
    }

    /*
      Prints a centered line, optionally followed by a newline
      =============================================================
      $string - String to print
      $newline - If TRUE the string will be followed by a newline
     */

    public function printCenteredString($string, $newline = TRUE)
    {

        $len = strlen($string);
        $diff = (Printer_Config::$charsPerLine - $len) / 2;

        //Print leading spaces
        for ($i = 0; $i < $diff; $i++)
        {
            fwrite($this->handle, " ");
        }

        fwrite($this->handle, $string);

        for ($i = 0; $i < $diff; $i++)
        {
            fwrite($this->handle, " ");
        }

        $this->printNewline($newline);
    }

    /*
      Prints a horizontal rule, optionally followed by a newline
      =============================================================
      $char - character to use for the newline
      $newline - If TRUE the string will be followed by a newline
     */

    public function printRule($char = '*', $newline = TRUE)
    {

        for ($i = 0; $i < Printer_Config::$charsPerLine; $i++)
        {
            fwrite($this->handle, $char);
        }

        $this->printNewline($newline);
    }

    /*
      Prints a left aligned and right aligned string on the same line
      =============================================================
      $left_string  - String to be printed on the left
      $right_string - String to be printed on the right
      $newline - If TRUE the string will be followed by a newline

     */

    public function printCartItem($left_string, $right_string, $padding = ' ', $newline = TRUE)
    {

        $l_len = strlen($left_string);
        $r_len = strlen($right_string);
        $total_length = $l_len + $r_len;

        if (($total_length) <= Printer_Config::$charsPerLine)
        {

            $diff = Printer_Config::$charsPerLine - ($total_length);

            fwrite($this->handle, $left_string);

            for ($i = 0; $i < $diff; $i++)
            {
                fwrite($this->handle, $padding);
            }

            fwrite($this->handle, $right_string);
        }
        else
        {
            //Strings are too long, shorten left string
            $diff = Printer_Config::$charsPerLine - $total_length - 5;
            $left_string = substr($left_string, 0, ($diff));
            $left_string .= "...";

            $this->printCartItem($left_string, $right_string, $padding, $newline);
            return;
        }

        $this->printNewline($newline);
    }

    /*
      Prints a newline if $bool is TRUE
      =============================================================
      $bool - Determines if a newline should be printed

      This was implemented to clean up the above public functions.
     */

    public function printNewline($bool)
    {
        if ($bool)
        {
            fwrite($this->handle, self::NEWLINE);
        }
    }

    /*
      Prints a Trailspace
      =============================================================

     */

    public function printTrailSpace()
    {
        fwrite($this->handle, self::TRAIL_SPACE);
    }

    public function closePrinter()
    {
        fclose($this->handle);
    }

}

?>