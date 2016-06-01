<?php

class reprint_imgtool
{
    public static function save(&$filename, $type='temp', $extid=0, $forcename='')
    {
        try {
            if (!is_file($filename)) {
                throw new Exception($filename.' is not file');
            }
            $type = self::check_dir_type($type);
            $fileext = self::fileext($filename);
            $isimage = self::is_image_ext($fileext);
            if (!$isimage) {
                throw new Exception($filename.' is not image file');
            }
            $extension = self::get_target_extension($fileext);
            $attachdir = self::get_target_dir($type, $extid);
            $attachment = $attachdir.self::get_target_filename($type, $forcename).'.'.$extension;
            $target = getglobal('setting/attachdir').'./'.$type.'/'.$attachment;

            if (!self::save_to_local($filename, $target)) {
                throw new Exception("save_to_local($filename, $target) FAIL");
            }
            $filename = $target;   

            global $_G;
            $siteurl = reprint_env::get_siteurl().'/';
			if(strpos($_G['setting']['attachurl'],'http') === false ){
				$url = $siteurl . $_G['setting']['attachurl'] . $type . '/' . $attachment;
			}else{
				$url = $_G['setting']['attachurl'] . $type . '/' . $attachment;
			}
            
            return $url;
        } catch (Exception $e) {
            runlog('reprint', $e->getMessage());
            return false;
        }
    }

    public function get_image_info($target, $allowswf = false) {
        $ext = self::fileext($target);
        $isimage = self::is_image_ext($ext);
        if(!$isimage && ($ext != 'swf' || !$allowswf)) {
            return false;
        } elseif(!is_readable($target)) {
            return false;
        } elseif($imageinfo = @getimagesize($target)) {
            list($width, $height, $type) = !empty($imageinfo) ? $imageinfo : array('', '', '');
            $size = $width * $height;
            if($size > 16777216 || $size < 16 ) {
                return false;
            } elseif($ext == 'swf' && $type != 4 && $type != 13) {
                return false;
            } elseif($isimage && !in_array($type, array(1,2,3,6,13))) {
                return false;
            } elseif(!$allowswf && ($ext == 'swf' || $type == 4 || $type == 13)) {
                return false;
            }
            return $imageinfo;
        } else {
            return false;
        }
    }

    function fileext($filename) {
        return addslashes(strtolower(substr(strrchr($filename, '.'), 1, 10)));
    }

    function is_image_ext($ext) {
        static $imgext  = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
        return in_array($ext, $imgext) ? 1 : 0;
    }

    function get_target_filename($type, $forcename = '') {
		$filename = $forcename.'_'.date('His').strtolower(random(16));
        return $filename;
    }

    function get_target_extension($ext) {
        static $safeext  = array('attach', 'jpg', 'jpeg', 'gif', 'png', 'swf', 'bmp', 'txt', 'zip', 'rar', 'mp3');
        return strtolower(!in_array(strtolower($ext), $safeext) ? 'attach' : $ext);
    }

    function get_target_dir($type, $extid = '', $check_exists = true) {

        $subdir = $subdir1 = $subdir2 = '';
        if($type == 'album' || $type == 'forum' || $type == 'portal' || $type == 'category' || $type == 'profile') {
            $subdir1 = date('Ym');
            $subdir2 = date('d');
            $subdir = $subdir1.'/'.$subdir2.'/';
        } elseif($type == 'group' || $type == 'common') {
            $subdir = $subdir1 = substr(md5($extid), 0, 2).'/';
        }

        $check_exists && self::check_dir_exists($type, $subdir1, $subdir2);

        return $subdir;
    }

    function check_dir_type($type) {
        return !in_array($type, array('forum', 'group', 'album', 'portal', 'common', 'temp', 'category', 'profile')) ? 'temp' : $type;
    }

    function check_dir_exists($type = '', $sub1 = '', $sub2 = '') {

        $type = self::check_dir_type($type);

        $basedir = !getglobal('setting/attachdir') ? (DISCUZ_ROOT.'./data/attachment') : getglobal('setting/attachdir');

        $typedir = $type ? ($basedir.'/'.$type) : '';
        $subdir1  = $type && $sub1 !== '' ?  ($typedir.'/'.$sub1) : '';
        $subdir2  = $sub1 && $sub2 !== '' ?  ($subdir1.'/'.$sub2) : '';

        $res = $subdir2 ? is_dir($subdir2) : ($subdir1 ? is_dir($subdir1) : is_dir($typedir));
        if(!$res) {
            $res = $typedir && self::make_dir($typedir);
            $res && $subdir1 && ($res = self::make_dir($subdir1));
            $res && $subdir1 && $subdir2 && ($res = self::make_dir($subdir2));
        }

        return $res;
    }

    function save_to_local($source, $target) {
        if(@copy($source, $target)) {
            $succeed = true;
        }elseif(function_exists('move_uploaded_file') && @move_uploaded_file($source, $target)) {
            $succeed = true;
        }elseif (@is_readable($source) && (@$fp_s = fopen($source, 'rb')) && (@$fp_t = fopen($target, 'wb'))) {
            while (!feof($fp_s)) {
                $s = @fread($fp_s, 1024 * 512);
                @fwrite($fp_t, $s);
            }
            fclose($fp_s); fclose($fp_t);
            $succeed = true;
        }
        if($succeed)  {
            @chmod($target, 0644);
            @unlink($source);
        } else {
            $this->errorcode = 0;
        }

        return $succeed;
    }

    function make_dir($dir, $index = true) {
        $res = true;
        if(!is_dir($dir)) {
            $res = @mkdir($dir, 0777);
            $index && @touch($dir.'/index.html');
        }
        return $res;
    }
}

?>
