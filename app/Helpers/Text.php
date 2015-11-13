<?php namespace App\Helpers;

class Text
{

    /**
     * Returns an excerpt from a given string (between 0 and passed limit variable).
     *
     * @param $string
     * @param int $limit
     * @param string $suffix
     * @return string
     */
    public static function shorten($string, $limit = 100, $suffix = '¡K')
    {
        if (strlen($string) < $limit) {
            return $string;
        }

        return substr($string, 0, $limit) . $suffix;
    }

    public static function showText($row)
    {
        return ((empty($row)) ? "" : "value=" . $row);
    }

    public static function showRadio($row, $n)
    {
        if (is_null($row)) {
            return "";
        }

        return ((ord($row) == $n) ? "checked" : "");
    }

    public static function showCheck($row, $n)
    {
        return ((substr($row, $n, 1) == "1") ? "checked" : "");
    }

    public static function selected($string, $value)
    {
        return ($string == $value ? "selected='selected'" : "");
    }

    public static function checked($str, $val)
    {
        return ($str == $val ? "checked='checked'" : "");
    }

    public static function showSelected($row, $n)
    {
        return (ord($row) == $n ? "selected" : "");
    }

    public static function behidden($row, $val)
    {
        return ($row == $val ? '' : 'hidden');
    }
}