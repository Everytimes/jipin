<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class xigua_parser {

    public static $l_delim = '{';
    public static $r_delim = '}';
    public static $object;

    public static function parse_string($template, $data)
    {
        return self::_parse($template, $data);
    }

    private static function _parse($template, $data)
    {
        if ($template == '')
        {
            return $template;
        }

        foreach ($data as $key => $val)
        {
            if (is_array($val))
            {
                $template = self::_parse_pair($key, $val, $template);
            }
            else
            {
                $template = self::_parse_single($key, (string)$val, $template);
            }
        }

        return $template;
    }

    public function set_delimiters($l = '{', $r = '}')
    {
        $this->l_delim = $l;
        $this->r_delim = $r;
    }

    private static function _parse_single($key, $val, $string)
    {
        return str_replace(self::$l_delim.$key.self::$r_delim, $val, $string);
    }

    private static function _parse_pair($variable, $data, $string)
    {
        if (FALSE === ($match = self::_match_pair($string, $variable)))
        {
            return $string;
        }

        $str = '';
        foreach ($data as $row)
        {
            $temp = $match['1'];
            foreach ($row as $key => $val)
            {
                if ( ! is_array($val))
                {
                    $temp = self::_parse_single($key, $val, $temp);
                }
                else
                {
                    $temp = self::_parse_pair($key, $val, $temp);
                }
            }

            $str .= $temp;
        }

        return str_replace($match['0'], $str, $string);
    }

    public function _match_pair($string, $variable)
    {
        if ( ! preg_match("|" . preg_quote(self::$l_delim) . $variable . preg_quote(self::$r_delim) . "(.+?)". preg_quote(self::$l_delim) . '/' . $variable . preg_quote(self::$r_delim) . "|s", $string, $match))
        {
            return FALSE;
        }

        return $match;
    }

}