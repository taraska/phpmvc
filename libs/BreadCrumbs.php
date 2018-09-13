<?php

class BreadCrumbs
{
    static public $arrayReplace = array();

    private function __construct()
    {
    }

    static public function breadCrumbs($request = null)
    {
        if (!empty($request)) {
            $crumbsArray = explode("/", trim($request, "/"));
            $crumbsArrayCopy = $crumbsArray;
            $count = count($crumbsArray);
            static $str;
            $normalArray = [];
            for ($i = 0; $i < $count; $i++) {
                $str .= $crumbsArray[$i] . '/';
                $normalArray[$i][] = $str;
                $normalArray[$i][] = array_shift($crumbsArrayCopy);
            }
            
            $breadCrumbs = static::replaceParams($normalArray);
            return $breadCrumbs;
        } else return null;
    }

    static private function replaceParams($normalArray)
    {
        static::$arrayReplace;
        foreach ($normalArray as $key => $value) {
            if (isset(static::$arrayReplace[$value[1]])) {
                $normalArray[$key][1] = static::$arrayReplace[$value[1]];
            }
        }
        return $normalArray;
    }
}