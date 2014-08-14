<?php

namespace Aoloe;

class Debug {
    public static function show($label, $value = null ) {
        Aoloe\debug($label, $value);
    }
}

error_reporting(E_ALL);
ini_set('display_errors', '1');

if (!isset($debug_log)) {
    $debug_log = false;
}

function debug($label, $value = null) {
    global $debug_log;
    if ($debug_log) {
        if (isset($value) && (is_array($value) || is_object($value)))
        {
            echo("<script>console.log('$label: ".json_encode($value)."');</script>");
        } else {
            if (is_null($value)) {
                $value = "<null>";
            } elseif ($value === false) {
                $value = "<false>";
            }
            echo("<script>console.log('$label: ".$value."');</script>");
        }
    } else {
        if (is_null($value)) {
            $value = "<null>";
        } elseif ($value === false) {
            $value = "<false>";
        } else {
            $value = print_r($value, 1);
        }
            echo("<pre>$label:\n".htmlentities($value)."</pre>");
    }
}
