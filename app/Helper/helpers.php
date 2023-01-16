<?php

if (! function_exists('getPermissionModelName')) {
    function getPermissionModelName($value)
    {
        if( isset($value) ) {
            $data = str_replace(".index", '', $value);
            $data = \Str::singular($data);
            return \Str::ucfirst($data);
        }
        return true;
    }
}

if (! function_exists('getPermissionName')) {
    function getPermissionName($value)
    {
        if( isset($value) ) {
            $data = explode(".", $value);
            return \Str::ucfirst($data[1]);
        }
        return true;
    }
}
