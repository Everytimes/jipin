<?php

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}


function xgb_delete_all($directory, $empty = false, $strict = false) {
    if(substr($directory,-1) == "/") {
        $directory = substr($directory,0,-1);
    }

    if(!file_exists($directory) || !is_dir($directory)) {
        return true;
    } elseif(!is_readable($directory)) {
        return false;
    } else {
        @$directoryHandle = opendir($directory);

        while ($contents = @readdir($directoryHandle)) {
            if($contents != '.' && $contents != '..') {
                $path = $directory . "/" . $contents;

                if(is_dir($path)) {
                    $ret = xgb_delete_all($path, $empty, $strict);
                    if($strict && !$ret){
                        return false;
                    }
                } else {
                    if(!@unlink($path)){
                        if($strict){
                            return false;
                        }
                    }
                }
            }
        }

        @closedir($directoryHandle);

        if($empty == false) {
            if(!@rmdir($directory)) {
                return false;
            }
        }

        return true;
    }
}