<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/29
 * Time: 17:31
 */

function xgn_delete_all($directory, $empty = false) {
    if(substr($directory,-1) == "/") {
        $directory = substr($directory,0,-1);
    }
    if(!file_exists($directory) || !is_dir($directory)) {
        return false;
    } elseif(!is_readable($directory)) {
        return false;
    } else {
        @$directoryHandle = opendir($directory);

        while ($contents = @readdir($directoryHandle)) {
            if($contents != '.' && $contents != '..') {
                $path = $directory . "/" . $contents;

                if(is_dir($path)) {
                    @xgn_delete_all($path);
                } else {
                    @unlink($path);
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