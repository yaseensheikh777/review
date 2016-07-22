<?php
function autoload($className) {
        $filename = str_replace('\\', '/', $className) . ".php";
        if (file_exists($filename)) {
            require($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }
        return FALSE;
    }
spl_autoload_register('autoload');