<?php
if (!defined('IN_MOBILE_API')) {
    exit('Access Denied');
}

$_GET['mod'] = 'post';
$_GET['action'] = 'newthread';
$_GET['topicsubmit'] = 'yes';
$_POST['posttime'] = time();
$charset = isset($_POST['charset']) ? $_POST['charset'] : 'utf-8';
if ($charset=='gbk' || $charset=='GBK') {
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')){
        
    } else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Android')){
        
    } else {
        $_POST['subject'] = iconv('UTF-8','GBK//ignore',$_POST['subject']);
        $_POST['message'] = iconv('UTF-8','GBK//ignore',$_POST['message']);
    } 
}
include_once 'forum.php';
class ReprintAPI 
{
    public function common()
    {
        global $_G;
    }

    public function output()
    {
        require_once dirname(__FILE__)."/../../libs/env.class.php";
		global $_G;
        $messageval = $_G['messageparam'][0];
        if ($messageval=='post_newthread_succeed') {
			$fromurl = isset($_POST["fromurl"]) ? $_POST["fromurl"] : "";
            $tid = $_G['hookscriptvalues']['tid'];
            C::t('#reprint#reprint_thread')->addThread($tid, $fromurl, $_G['username']);
            $res = array (
                'retcode' => 0,
                'retmsg'  => $messageval,
                'data' => $_G['hookscriptvalues'],
            );
            
            
            $imgfile = isset($_POST['coverimg']) ? $_POST['coverimg'] : "";
            if ($imgfile != "") {
			    $basedir = !$_G['setting']['attachdir'] ? (DISCUZ_ROOT.'./data/attachment/') : $_G['setting']['attachdir'];
			    $coverdir = 'threadcover/'.substr(md5($tid), 0, 2).'/'.substr(md5($tid), 2, 2).'/';
			    $path = $basedir.'./forum/'.$coverdir;
			    dmkdir($path);
			    if (is_dir($path)) {
				    $coverfile = $path."$tid.jpg";
				    @copy($imgfile, $coverfile);
				    $res['coverfile'] = $coverfile;
			    }
                C::t('forum_thread')->update($tid, array('cover' => 1));
            }
            
            reprint_env::result($res);
        }
        else {
			$message_result = lang('plugin/mobile', $_G['messageparam'][0], $_G['messageparam'][2]);
			if($message_result == $_G['messageparam'][0]) {
				$vars = explode(':', $_G['messageparam'][0]);
				if (count($vars) == 2) {
					$message_result = lang('plugin/' . $vars[0], $vars[1], $_G['messageparam'][2]);
					$_G['messageparam'][0] = $vars[1];
				} else {
					$message_result = lang('message', $_G['messageparam'][0], $_G['messageparam'][2]);
				}
			}
			$message_result = strip_tags($message_result);
            $retmsg = reprint_utils::piconv($_G['charset'],'UTF-8',$message_result);
            $res = array (
                'retcode' => 100010,
                'retmsg' => $retmsg,
            );
            reprint_env::result($res);
        }
    }

    public function setcover($tid, $imgfile) 
    {
        global $_G;
        $basedir = !$_G['setting']['attachdir'] ? (DISCUZ_ROOT.'./data/attachment/') : $_G['setting']['attachdir'];
        $coverdir = 'threadcover/'.substr(md5($tid), 0, 2).'/'.substr(md5($tid), 2, 2).'/';
        $path = $basedir.'./forum/'.$coverdir;
        dmkdir($path);
        if (is_dir($path)) {
            $coverfile = $path."/.$tid.jpg";
            @copy($imgfile, $coverfile);
            return true;
        }
        return false;
    }
}
?>
