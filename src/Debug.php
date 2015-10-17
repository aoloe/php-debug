<?php

/**
 * render debug values or optionally output them to the console.log
 */

namespace Aoloe;

class Debug {
    public static function show($label, $value = null ) {
        Aoloe\debug($label, $value);
    }
}

error_reporting(E_ALL);
ini_set('display_errors', '1');

// TODO: we should use a constant for this
// TODO: we could use a _REQUEST parameter for this too
if (!isset($debug_log)) {
    $debug_log = false;
}

function debug($label, $value = null) {
    global $debug_log;
    $bt = debug_backtrace();
    $bt = reset($bt);
    $caller = "[".basename($bt['file'])."::".$bt['line']."]";
    if (is_null($value)) {
        $value = "<null>";
    } elseif ($value === false) {
        $value = "<false>";
    } elseif ($value === true) {
        $value = "<true>";
    } elseif (isset($value) && (is_array($value) || is_object($value))) {
        $value = $debug_log ? json_encode($value) : print_r($value, 1);
    }
    if ($debug_log) {
        echo("<script>console.log('$caller $label: ".$value."');</script>");
    } else {
        echo("<pre><span title=\"{$bt['file']}\">$caller</span> $label:\n".htmlentities($value)."</pre>");
    }
}
